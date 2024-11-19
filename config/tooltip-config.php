<?php

return [
    'adjudication' => [
        'adjudication_boundary_map_link' => 'URL link to a page of adjudication maps.',
        'adjudication_document_id' => '',
        'adjudication_document_type' => '',
        'adjudication_hydro_boundary_type' => 'The type of boundary for this adjudication e.g. - Ground Water, Surface Water, Civic etc',
        'adjudication_id' => '',
        'adjudication_name' => 'Title of the Adjudication',
        'adjudication_nickname' => 'Short name of the Adjudication - optional',
        'adjudication_type' => 'Pueblo, Tribes and Nations or Regular',
        'adjudication_status' => 'Status of the adjudication',
        'bureau' => 'Name of the Bureau responsible for the adjudication',
        'coordinate_system' => 'State Plane Coordinate System',
        'datum' => 'Datum used by Water Resource Professionals for Coordinates',
        'hydrographic_survey_description' => '',
        'mapping_zone_central' => '',
        'mapping_zone_east' => '',
        'mapping_zone_west' => '',
        'prefix' => 'aka parent level basin code of the adjudication sections basins where applicable.',
    ],
    'adjudication_courts' => [
        'adjudication_courts_id' => 'TBD',
        'case_number' => 'TBD',
        'case_name' => 'TBD',
        'court_docket_link' => 'URL link to the court page containing the docket information.',
        'court' => 'Name of the court responsible for the case.',
        'docket_number' => 'Identifier of the docket(s) affiliated with the case.',
        'judge_name' => 'Name of the judge assigned to the case.',
        'judge_signature_image_file_name' => "Internal OSE link to an image file containing the judge's signature.",
    ],
    'adjudication_document' => [
        'adjudication_document_code' => 'tbd',
        'adjudication_document_id' => 'tbd',
        'adjudication_document_title' => 'Title of the document',
        'adjudication_document_type_id' => 'Type of document',
        'created_at' => 'tbd',
        'created_by' => 'tbd',
        'document_name' => 'Description of document',
        'document_sort' => 'tbd',
        'document_status' => 'tbd',
        'event_code' => 'tbd',
        'updated_at' => 'tbd',
        'updated_by' => 'tbd',
        'wrats_status_indicator' => 'tbd',
        'attachment_URL' => 'Relative web address of the document',
        'attachment_file_path' => 'Physical file path of the document',
        'comments' => 'Comments related to acceptance/rejection of the document',
    ],
    'adjudication_sections' => [
        'adjudication_hydro_boundary_type' => 'The type of boundary for this adjudication e.g. - Ground Water, Surface Water, Civic etc',
        'adjudication_section_name' => 'Name of the section (aka Basin where applicable) for a portion of the adjudication',
        'adjudication_section_status' => 'Status of the adjudication section',
        'adjudication_section_type' => 'Pueblo, Tribes and Nations or Adjudication Section',
        'adjudication_section_id' => '',
        'boundary_name' => 'Common name for this boundary (e.g. Lower Rio Grande Underground Basin)',
        'prefix' => 'aka Basin Code where applicable',
        'section_type' => 'Pueblo, Tribes and Nations or Adjudication Section',
    ],
    'defendant_documents' => [
        'defendant_document_title' => 'Title of the Document',
        'contact_email_id' => 'Primary email address of the defendant',
        'contact_telephone_id' => 'Primary telephone number of the defendant',
        'created_at' => '',
        'created_by' => 'Created by',
        'defendant' => 'Name of defendant referred to in the document',
        'defendant_document_type_id' => 'tbd',
        'defendant_documents_date' => 'Date of document, usually the filing date',
        'defendant_documents_desc' => 'Description of document',
        'defendant_documents_id' => '',
        'docket_id' => 'Docket ID in the court’s docketing system, if any',
        'o_id' => 'Owner',
        'party_id' => 'Party',
        'party_status_id' => 'Indicator of whether person is verified',
        'party_type_id' => 'Owner or Other',
        'updated_at' => '',
        'updated_by' => '',
        'attachment_URL' => 'Relative web address of the document',
        'attachment_file_path' => 'Physical file path of the document',
    ],
    'global_documents' => [
        'created_at' => '',
        'created_by' => 'Created by',
        'doc_date' => 'Date of document, usually the filing date',
        'docket_id' => 'Docket ID in the court’s docketing system, if any',
        'global_desc' => 'Description of document',
        'global_document_id' => '',
        'global_document_type_id' => 'Type of document',
        'global_id' => '',
        'global_id_access' => '',
        'global_title' => 'Title of document',
        'updated_at' => '',
        'updated_by' => '',
        'attachment_URL' => 'Relative web address of the document',
        'attachment_file_path' => 'Physical file path of the document',
    ],
    'global_document_PODS' => [
        'created_at' => 'tbd',
        'created_by' => 'Created by',
        'doc_date' => 'Doc date',
        'docket_id' => 'Docket ID in the court’s docketing system, if any',
        'pod_global_desc' => 'Description of document',
        'pod_global_documents_id' => 'ID of the global document',
        'pod_global_id' => 'tbd',
        'pod_global_id_access' => 'tbd',
        'pou_global_title' => 'tbd',
        'updated_at' => 'Title of the document',
        'updated_by' => 'tbd',
    ],
    'global_document_POUs' => [
        'doc_date' => 'Date of document, usually the filing date',
        'docket_id' => 'Docket ID in the court’s docketing system, if any',
        'pou_global_desc' => 'Description of document',
        'pou_global_documents_id' => 'ID of the global document',
        'pou_global_id' => 'tbd',
        'pou_global_id_access' => 'tbd',
        'pou_global_title' => 'Title of the document',
        'updated_at' => 'tbd',
        'updated_by' => 'tbd',
    ],
    'global_document_water_rights' => [
        'created_at' => 'tbd',
        'created_by' => 'Created by',
        'doc_date' => 'Date of document, usually the filing date',
        'docket_id' => 'Docket ID in the court’s docketing system, if any',
        'updated_at' => 'tbd',
        'updated_by' => 'tbd',
        'water_right_global_desc' => 'Description of document',
        'water_right_global_documents_id' => 'ID of the global document',
        'water_right_global_id' => 'tbd',
        'water_right_global_id_access' => 'tbd',
        'water_right_global_title' => 'tbd',
        'water_right_id' => 'ID of the water right',
    ],
    'hydrographic_documents' => [
        'created_at' => '',
        'created_by' => 'Created by',
        'hydrographic_document_name' => 'Description of document',
        'hydrographic_document_owner' => 'Name of person referred to in the document',
        'hydrographic_document_owner_date' => 'Date of document, usually the filing date',
        'hydrographic_document_owner_status' => 'Indicator of whether person is verified',
        'hydrographic_document_owner_type' => 'Role of the person',
        'hydrographic_document_type_id' => 'Type of document',
        'hydrographic_documents_id' => '',
        'updated_at' => '',
        'updated_by' => '',
        'attachment_URL' => 'Relative web address of the document',
        'attachment_file_path' => 'Physical file path of the document',
    ],
];