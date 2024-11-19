<div class="row-detail-class">
    <table class="table-auto w-full sections-row-detail">
        <tbody>
            @foreach ($row->subsections as $subsection)
                <tr>
                    <td class="table-cell" style="padding-left: 70px; width: 130px;">
                        {{ $subsection->child_adjudication_subsection_id }}
                    </td>
                    <td class="table-cell" style="width: 230px;">
                        @if ($subsection->childSection)
                            {{ $subsection->childSection->adjudication_section_name }}
                        @else
                                Section not found
                        @endif
                    </td>
                    <td class="table-cell" style="width: 150px;">
                        @if ($subsection->childSection)
                            {{ $subsection->childSection->prefix }}
                        @else
                                Section not found
                        @endif
                    </td>
                    <td class="table-cell" style="width: 150px;">
                        @if ($subsection->childSection)
                            {{ $subsection->childSection->adjudication_section_type->adjudication_section_type_code }}
                        @else
                                Section not found
                        @endif
                    </td>
                    <td class="table-cell" style="width: 150px;">
                        @if ($subsection->childSection)
                            {{ $subsection->childSection->adjudication_section_status->adjudication_section_status_description }}
                        @else
                                Section not found
                        @endif
                    </td>
                    <td class="table-cell" style="width: 150px;">
                        @if ($subsection->childSection)
                            maps
                        @else
                            Section not found
                        @endif
                    </td>
                    <td class="table-cell" style="width: 150px;">
                        @if ($subsection->childSection)
                            {{ $subsection->childSection->boundary_name }}
                        @else
                                Section not found
                        @endif
                    </td>
                    <td class="table-cell" style="width: 100px; padding-left: 20px;">
                        <div class="dropdown">
                            <i
                                class="bi bi-three-dots-vertical btn"
                                data-bs-toggle="dropdown"
                                aria-expanded="false"
                            ></i>
                            <ul class="dropdown-menu">
                                <li>
                                    <button
                                        class="dropdown-item"
                                        type="button"
                                        data-bs-target="#adjudicationSectionsModal"
                                        data-bs-toggle="modal"
                                        data-bs-dismiss="modal"
                                        wire:click="edit({{ $subsection->childSection->id }})"
                                    >
                                        Edit
                                    </button>
                                </li>
                                <!-- <li>
                                    <button
                                        class="dropdown-item text-danger"
                                        type="button"
                                        onclick="confirm('Are you sure you want to delete this Adjudication Section?')"
                                    >
                                        Delete
                                    </button>
                                </li>//TODO: add back in when subsection delete is implemented -->
                            </ul>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
