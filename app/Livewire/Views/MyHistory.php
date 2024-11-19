<?php

namespace App\Livewire\Views;

use App\Models\WratsUserApplicationHistory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class MyHistory extends Component
{
    public $search = '';

    public $dateRange = '';

    public $selectedRecordType = 'All Types';

    public $groupedItems = [];

    public function mount($groupedItems = [])
    {
        $this->groupedItems = $groupedItems;
    }

    public function fetchData()
    {
        $query = WratsUserApplicationHistory::query();

        //filter by dateRange
        if ($this->dateRange) {
            // Log::info('date range filter');
            $dates = explode(' - ', $this->dateRange);
            $startDate = Carbon::parse($dates[0])->startOfDay();
            $endDate = Carbon::parse($dates[1])->endOfDay();
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        //filter by search bar (label and parameters)
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('label', 'like', '%'.$this->search.'%')
                    ->orWhere('parameters', 'like', '%'.$this->search.'%');
            });
        }

        // // Apply record type filter
        if ($this->selectedRecordType !== 'All Types') {
            $query->where('record_type', $this->selectedRecordType);
        }

        $wratsUserApplicationHistories = $query->orderBy('created_at', 'desc')->get();

        $this->groupedItems = [];
        foreach ($wratsUserApplicationHistories as $record) {
            $date = Carbon::parse($record->created_at)->toDateString();
            $this->groupedItems[$date][] = $record;
        }

        Log::info('groupedItems: '.json_encode($this->groupedItems));
    }

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['search', 'dateRange', 'selectedRecordType'])) {
            $this->fetchData();
        }
    }

    public function getLabelForDate($date)
    {
        $date = Carbon::parse($date);
        $today = Carbon::today()->toDateString();
        $yesterday = Carbon::yesterday()->toDateString();

        if ($date === $today) {
            return 'Today';
        } elseif ($date === $yesterday) {
            return 'Yesterday';
        } else {
            return $date->format('m/d/Y');
        }
    }

    public function selectRecordList($type)
    {
        $this->selectedRecordType = $type;
        $this->fetchData();
    }

    public function render()
    {
        return view('livewire.views.my-history');
    }
}
