<?php

namespace Database\Seeders;

use App\Imports\MultipleSheetsImport;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        \Schema::disableForeignKeyConstraints();
        //reads data from wratsapplicationdata excel sheets, runs MultipleSheetsImport to seed data
        Excel::import(new MultipleSheetsImport, database_path('seeders/WratsApplicationData.xlsx'));
        $this->call([
            // UserSeeder::class,
            PermissionsSeeder::class,

            CourtSeeder::class,
            // AdjudicationDistrictSeeder::class,
            // AdjudicationCourtSeeder::class,
            // AdjudicationDocumentTypeSeeder::class,
            // AdjudicationHydroBoundaryTypeSeeder::class,
            // AdjudicationSectionStatusSeeder::class,
            // AdjudicationSectionTypeSeeder::class,
            // AdjudicationStatusSeeder::class,
            // AdjudicationSubsectionSeeder::class,
            // AmountCategorySeeder::class,
            // AttorneyListSeeder::class,
            // AttorneySeeder::class,
            BureauSeeder::class,
            BureauUserSeeder::class,
            // CitySeeder::class,
            // ClaimResolutionSeeder::class,
            // ClaimStatusSeeder::class,
            // ClaimTypeSeeder::class,
            // ContactAddressSeeder::class,
            // ContactEmailSeeder::class,
            // ContactTelephoneSeeder::class,

            CountrySeeder::class,
            StateSeeder::class,
            CountySeeder::class,
            CitySeeder::class,

            CourtRoleSeeder::class,
            CourtCasesSeeder::class,
            CourtPersonnelSeeder::class,

            // DefendantDocumentsTypeSeeder::class,
            // DefendantTypeSeeder::class,
            // DocumentDefinitionSeeder::class,
            // FieldWorkSeeder::class,
            // FileLocationSeeder::class,
            // FlatRaterSeeder::class,
            // GisDuplicateSeeder::class,
            // GlobalDocumentTypeSeeder::class,
            // GrantSeeder::class,
            // HsRecommendationSeeder::class,
            // HydrographicDocumentTypeSeeder::class,
            // IrrigationSeeder::class,
            // PartyAliasTypeSeeder::class,
            // PartyInterestTypeSeeder::class,
            // PartyStatusSeeder::class,
            // PartyTypeSeeder::class,
            // PartyTypeSubtypeSeeder::class,
            // PermissionSeeder::class,
            // PodGlobalDocumentSeeder::class,
            // PouCommentSeeder::class,
            // PouGlobalDocumentSeeder::class,
            // PouStatusSeeder::class,
            // PouWaterRightSeeder::class,
            // SurfaceZoneSeeder::class,
            // abstractingDocumentTypeSeeder::class,
            // UseCodeSeeder::class,
            UserSettingSeeder::class,
            // WaterBasinSeeder::class,
            // WaterRightCommentCategorySeeder::class,
            // WaterRightGlobalDocumentSeeder::class,
            // WaterRightUseSeeder::class,
            WaterSourceSeeder::class,
            // WatersStatusSeeder::class,
            WratsUserSeeder::class,
            // NoUseSeeder::class,
            // CountySeeder::class,
            // ClaimFieldCheckSeeder::class,
            // BasinUserSeeder::class,
            // AttorneyListingSeeder::class,
            // AttorneyAttorneyListSeeder::class,
            AdjudicationSeeder::class,
            AdjudicationSectionSeeder::class,
            AdjudicationDocumentSeeder::class,

            // WaterRightSeeder::class, //TODO: comment this out if you need to reseed faster

            // GlobalDocumentSeeder::class,

            // AdjudicationXyDatumSeeder::class,
            // ProgramSeeder::class,
            // PartyAliasSeeder::class,
            // PartySeeder::class,
            // OwnerCommentSeeder::class,
            // GroundPodSeeder::class,
            // PodNameHistorySeeder::class,
            // WaterRightCommentSeeder::class,
            // PouNonIrrigationSeeder::class,
            // abstractingDocumentPouSeeder::class,
            // abstractingDocumentOwnerSeeder::class,
            // abstractingDocumentDetailSeeder::class,
            // AdjudicationDocumentProgramSeeder::class,
            // abstractingSeeder::class,
            // abstractingCommentSeeder::class,
            // ImportErrorSeeder::class,
            // GroundPodCommentSeeder::class,
            // EbidParcelSeeder::class,
            DefendantDocumentSeeder::class,
            // DbFileSeeder::class,
            // ConditionCommentSeeder::class,
            // ConditionSeeder::class,
            // MissingPouirrSeeder::class,

            // PodCommentSeeder::class,
            // SurfacePodSeeder::class,
            // SubfilePartySeeder::class,
            // PodDbFileSeeder::class,
            // PodRightSeeder::class,
            // PodTypeSeeder::class,
            // PodUseSeeder::class,
            // PodWaterRightSeeder::class,
            SubfilesSeeder::class,
            PersonsSeeder::class,
            PersonTypesSeeder::class,
            PersonStatusSeeder::class,
            GlobalDocumentPOUSeeder::class,

            // AddressSeeder::class,
            CourtCaseAdjudicationSectionSeeder::class,

            WratsUserApplicationHistorySeeder::class,
            GlobalDocumentSubfileSeeder::class,
            SubfileCourtCaseSeeder::class,
            HydrographicDocumentSeeder::class,
            SubfilePersonSeeder::class,

            PodSeeder::class,

        ]);
        \Schema::enableForeignKeyConstraints();
    }
}
