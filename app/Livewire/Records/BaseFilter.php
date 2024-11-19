<?php

namespace App\Livewire\Records;

use App\Models\Adjudication;
use App\Models\Subfile;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Session;
use Livewire\Component;

abstract class BaseFilter extends Component
{
    public array $filters = [];

    #[Session]
    public array $appliedFilters = [];

    public bool $showFilters = false;

    public bool $disabled = false;

    public Collection $subfileOptions;

    public Collection $modelOptions;

    public $subfileSelectionFilter = null;

    public $modelSelectionFilter = null;

    public function mount(): void
    {
        $this->subfileOptions = Subfile::all();
        $this->updateModelOptions();

        // Restore previously applied filters from session
        $this->filters = $this->appliedFilters;
    }

    public function toggleFilters(): void
    {
        $this->showFilters = ! $this->showFilters;
    }

    public function cancelFilter(): void
    {
        $this->clearAll();
        $this->toggleFilters();
    }

    public function clearAll(): void
    {
        $this->subfileSelectionFilter = null;
        $this->modelSelectionFilter = null;

        $this->reset('filters');
        $this->reset('appliedFilters');
        $this->dispatch('applyFilters', $this->appliedFilters);
    }

    public function applyFilters(): void
    {
        $this->appliedFilters = $this->filters;
        $this->dispatch('applyFilters', $this->appliedFilters);
    }

    protected function updateModelOptions(): void
    {
        $this->modelOptions = $this->base()->get();
    }

    public function render(): View
    {
        return view($this->view());
    }

    /** Base query for model */
    abstract public function base(): Builder;

    /** Name and path of the view to load */
    protected function view(): string
    {
        $name = str(static::class)->afterLast('\\')->kebab()->toString();

        return "livewire.records.$name";
    }

    public function selectAllChildren(string $class, int $id, string $propertyName): void
    {
        throw_unless(is_subclass_of($class, Model::class));

        $model = $class::findOrFail($id);

        $value = $this->filters[$propertyName][$id];
        if ($model instanceof Adjudication) {
            $model->adjudication_sections->pluck('id')
                ->each(fn (int $id) => $this->filters['adjudicationSectionIds'][$id] = $value);
        }
    }

    #[Computed]
    public function activeFiltersCount(): int
    {
        return collect($this->appliedFilters)->filter()->count();
    }
}
