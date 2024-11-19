<?php

namespace App\Livewire\Records;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;
use Livewire\Attributes\Session;
use Livewire\Component;
use Livewire\WithPagination;

abstract class Base extends Component
{
    use WithPagination;

    public const PER_PAGE = 10;

    /** @var string The pagination theme for the component. */
    protected string $paginationTheme = 'bootstrap';

    /** @var string[] Event Listeners */
    protected $listeners = [
        'refresh' => '$refresh',
        'applyFilters' => 'filters',
    ];

    /** @var array Eager loaded relationships */
    protected array $with = [];

    #[Session]
    public array $filters = [];

    /** Returns the eloquent base query for the represented model */
    abstract protected function base(): Builder;

    /** Returns the (possibly nested) relationship to the Subfile model */
    abstract protected function subfileRelationship(): string;

    public function getSubfileRelationship(?string $relation = null): string
    {
        $subfileRelationship = $this->subfileRelationship();

        if (empty($relation)) {
            return $this->subfileRelationship();
        }

        if (empty($subfileRelationship)) {
            return $relation;
        }

        return $this->subfileRelationship().'.'.$relation;
    }

    /** Name and path of the view to load */
    protected function view(): string
    {
        $name = str(static::class)->afterLast('\\')->kebab()->toString();

        return "livewire.records.$name";
    }

    private function getFilter(string $filterName): array|string|bool|null
    {
        if (empty($this->filters[$filterName])) {
            return null;
        }

        $filter = $this->filters[$filterName];

        if (is_string($filter)) {
            return $filter;
        }

        if (is_array($filter)) {
            return collect($filter)
                ->filter(fn ($value) => $value) // checked checkbox returns true, unchecked false
                ->keys() // before: [6 => true, 9 => false, 120 => true, ...] | after: [6, 120, ...]
                ->all(); // return normal array instead of collection
        }

        if (is_bool($filter)) {
            return $filter;
        }

        return null;
    }

    public function render(): View
    {
        $query = $this->base()
            ->when(! empty($this->getFilter('adjudicationSectionIds')), fn ($query) => $query->whereHas(
                $this->getSubfileRelationship('adjudication_section'),
                fn ($query) => $query->whereIn('id', $this->getFilter('adjudicationSectionIds')),
            ))
            ->when(! empty($this->getFilter('adjudicationStatusIds')), fn ($query) => $query->whereHas(
                $this->getSubfileRelationship('adjudication_section.adjudication.adjudication_status'),
                fn ($query) => $query->whereIn('id', $this->getFilter('adjudicationStatusIds')),
            ))
            ->when(! empty($this->getFilter('subfileStatusIds')), fn ($query) => $query->whereHas(
                $this->getSubfileRelationship('subfile_adjudication_status'),
                fn ($query) => $query->whereIn('id', $this->getFilter('subfileStatusIds')),
            ))
            ->when(! empty($this->getFilter('waterRightStatusIds')), fn ($query) => $query->whereHas(
                $this->getSubfileRelationship('water_rights.waters_status'),
                fn ($query) => $query->whereIn('id', $this->getFilter('waterRightStatusIds')),
            ))
            ->when(! empty($this->getFilter('statusUseIds')), fn ($query) => $query->whereHas(
                $this->getSubfileRelationship('water_rights.pous.pou_status'),
                fn ($query) => $query->whereIn('id', $this->getFilter('statusUseIds'))
            ))
            ->when(! empty($this->getFilter('waterSourceIds')), fn ($query) => $query->whereHas(
                $this->getSubfileRelationship('water_rights.water_source'),
                fn ($query) => $query->whereIn('id', $this->getFilter('waterSourceIds'))
            ))
            ->when(! empty($this->getFilter('conveyanceIds')),
                fn ($query) => $query->whereHas(
                    $this->getSubfileRelationship('water_rights.pods.ground_pods'),
                    fn ($query) => $query->whereIn('ground_pod_source_text', $this->getFilter('conveyanceIds'))
                )->orWhereHas(
                    $this->getSubfileRelationship('water_rights.pods.surface_pods'),
                    fn ($query) => $query->whereIn('surface_pod_source_text', $this->getFilter('conveyanceIds'))
                )
            )
            ->when(! empty($this->getFilter('batch')), fn ($query) => $query->whereHas(
                $this->getSubfileRelationship(),
                fn ($query) => $query->where('batch', $this->getFilter('batch'))
            ))
            ->when(! empty($this->getFilter('fileType')), fn ($query) => $query->whereHas(
                $this->getSubfileRelationship('file_location'),
                fn ($query) => $query->where('id', $this->getFilter('fileType')->orWhere('file_location_description', $this->getFilter('fileType')))
            ))
            ->when(
                ! empty($this->getFilter('dateStart')) && ! empty($this->getFilter('dateEnd')),
                fn ($query) => $query->whereBetween('created_at', $this->getFilter('dateStart'), $this->getFilter('dateEnd')),
            )
            ->when(! empty($this->getFilter('personTypeIds')), fn ($query) => $query->whereHas(
                $this->getSubfileRelationship('people.person_type'),
                fn ($query) => $query->whereIn('id', $this->getFilter('personTypeIds'))
            ))
            ->when(! empty($this->getFilter('personTypeSubtypeIds')), fn ($query) => $query->whereHas(
                $this->getSubfileRelationship('people.person_type_subtype'),
                fn ($query) => $query->whereIn('id', $this->getFilter('personTypeSubtypeIds'))
            ))
            ->when(! empty($this->getFilter('personStatusIds')), fn ($query) => $query->whereHas(
                $this->getSubfileRelationship('people.person_status'),
                fn ($query) => $query->whereIn('id', $this->getFilter('personStatusIds'))
            ))
            ->when(! empty($this->getFilter('courtIds')), fn ($query) => $query->whereHas(
                $this->getSubfileRelationship('court_cases.court'),
                fn ($query) => $query->whereIn('id', $this->getFilter('courtIds'))
            ))
            ->when(! empty($this->getFilter('countyIds')), fn ($query) => $query->whereHas(
                $this->getSubfileRelationship('water_rights.pous.pou_irrigations.county'),
                fn ($query) => $query->whereIn('id', $this->getFilter('countyIds'))
            ))
            ->when(! empty($this->getFilter('cityIds')), fn ($query) => $query->whereHas(
                $this->getSubfileRelationship('water_rights.pous.pou_irrigations.city'),
                fn ($query) => $query->whereIn('id', $this->getFilter('cityIds'))
            ))
            ->when(! empty($this->getFilter('grantIds')), fn ($query) => $query->whereHas(
                $this->getSubfileRelationship('water_rights.pous.pou_irrigations.grant'),
                fn ($query) => $query->whereIn('id', $this->getFilter('grantIds'))
            ))
            ->when(! empty($this->getFilter('mapNumber')),
                fn ($query) => $query->whereHas(
                    $this->getSubfileRelationship('water_rights.pods'),
                    fn ($query) => $query->where('pod_map_txt', $this->getFilter('mapNumber'))
                )->orWhereHas(
                    $this->getSubfileRelationship('water_rights.pous'),
                    fn ($query) => $query->where('pou_map_txt', $this->getFilter('mapNumber'))
                )
            )
            ->unless(empty($this->getFilter('watchingSubfiles')), fn ($query) => $query->whereHas(
                $this->getSubfileRelationship('subfile_user_watches'),
                fn ($query) => $query->where('wrats_user_id', auth()->user()->id),
            ));

        return view($this->view(), [
            'models' => $query->paginate(self::PER_PAGE),
        ]);
    }

    public function filters(array $filters = []): void
    {
        $this->filters = $filters;
    }
}
