<div>
    <!-- {{-- Conditionally display Livewire components based on the type --}} -->
    @if ($type === 'global')
        @livewire('components.document-management-global-form', ['document_id' => $document_id])
    @elseif ($type === 'defendant')
        @livewire('components.document-management-defendant-form', ['document_id' => $document_id])
    @elseif ($type === 'adjudication')
        @livewire('components.document-management-adjudication-form', ['type' => $type, 'document_id' => $document_id])
    @elseif ($type === 'hydrographic')
        @livewire('components.document-management-hydrographic-form', ['type' => $type, 'document_id' => $document_id])
    @endif
</div>
