<?php

namespace App\Livewire\Records;

use App\Models\Pou;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\PowerGridFields;

final class PlacesOfUsePowergrid extends PowerGridComponent
{
    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Header::make(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        // Eager load water_rights relationship directly
        return Pou::query()->with([
            'pou_irrigations.county',
            'pou_non_irrigations',
            'pou_status',
            'water_rights.subfile.adjudication_section',
        ]);
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('plid', fn (Pou $model) => $model->id)
            ->add('place_type', fn (Pou $model) => $model->pou_irrigations->isNotEmpty() ? 'Irrigation' : ($model->pou_non_irrigations->isNotEmpty() ? 'Non-Irrigation' : 'N/A'))
            ->add('acres', fn (Pou $model) => $model->rev_hs_acres)

            // Updated subfiles logic to display the first subfile and show a bubble if there are more subfiles
            ->add('subfiles', function (Pou $model) {
                $subfiles = $model->water_rights->filter(fn ($waterRight) => $waterRight->subfile);
                $firstSubfile = $subfiles->first()?->subfile;
                $subfileCount = $subfiles->count();

                if ($firstSubfile) {
                    $formattedSubfile = strtoupper(
                        $firstSubfile->basin_section_hl.'-'.
                        $firstSubfile->sub_file_hl_txt.'-'.
                        $firstSubfile->subfile_hl_suffix.'/'.
                        ($firstSubfile->hs_doc_heading ?? 'N/A')
                    );

                    // Show the formatted subfile with a bubble for additional subfiles
                    return $subfileCount === 1
                        ? $formattedSubfile
                        : "$formattedSubfile <span class='badge badge-brownbubble'>+".($subfileCount - 1).'</span>';
                }

                return 'N/A';
            })

            // Get adjudication_section_name from water_rights -> subfiles -> adjudication_section
            ->add('section', function (Pou $model) {
                $firstWaterRight = $model->water_rights->first();
                if ($firstWaterRight && $firstWaterRight->subfile && $firstWaterRight->subfile->adjudication_section) {
                    return $firstWaterRight->subfile->adjudication_section->adjudication_section_name;
                }

                return 'N/A';
            })

            ->add('county', fn (Pou $model) => $model->pou_irrigations->isNotEmpty() && $model->pou_irrigations->first()->county
                ? $model->pou_irrigations->first()->county->county_name
                : 'N/A')

            // Update the status_use to show pou_status_code as a badge
            ->add('status_use', fn (Pou $model) => $model->pou_status
                    ? "<span class='badge badge-bluebubble'>".$model->pou_status->pou_status_code.'</span>'
                    : 'N/A'
            )

            ->add('updated', fn (Pou $model) => $model->updated_at->format('m/d/Y'));
    }

    public function columns(): array
    {
        return [
            Column::make('PLID', 'plid')
                ->searchable()
                ->sortable(),

            Column::make('Place Type', 'place_type')
                ->searchable(),

            Column::make('Acres', 'acres')
                ->searchable(),

            Column::make('Subfile(s)', 'subfiles')
                ->searchable(),

            Column::make('Section', 'section')
                ->searchable(),

            Column::make('County', 'county')
                ->searchable(),

            Column::make('Status Use', 'status_use')
                ->searchable(),

            Column::make('Updated', 'updated')
                ->searchable(),
        ];
    }
}
