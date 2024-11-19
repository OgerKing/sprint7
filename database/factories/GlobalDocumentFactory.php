<?php

namespace Database\Factories;

use App\Models\Adjudication;
use App\Models\GlobalDocument;
use App\Models\Subfile;
use Illuminate\Database\Eloquent\Factories\Factory;

class GlobalDocumentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = GlobalDocument::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {

        return [
            //'subfile_id' => Subfile::factory(),
            'adjudication_id' => Adjudication::inRandomOrder()->value('id'),
            'global_document_title' => $this->faker->word,
            'document_filing_date' => $this->faker->dateTime(),
            'attachment_file_path' => $this->faker->url,
            'global_document_type_id' => 1,
            'docket_id' => $this->faker->regexify('[A-Za-z0-9]{10}'),
            'global_desc' => $this->faker->text(2000),
            'global_id_access' => $this->faker->randomNumber(),
            'created_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
            'updated_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
        ];
    }
}
