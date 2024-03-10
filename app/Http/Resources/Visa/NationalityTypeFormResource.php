<?php


namespace App\Http\Resources\Visa;


use Illuminate\Http\Resources\Json\JsonResource;

class NationalityTypeFormResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $response = [
            'id' => $this->id,
            'processing_time' => $this->processing_time,
            'visa_validity' => $this->visa_validity,
            'stay_validity' => $this->stay_validity,
            'adult_price' => intval($this->adult_price),
            'child_price' => intval($this->child_price),
            'infant_price' => intval($this->infant_price),
        ];
        if (!$this->requirements_main()->isEmpty()) {
            foreach ($this->requirements_main() as $key => $requirement) {
                $response['requirements_main'][$key]['type'] = $requirement->type;
                $response['requirements_main'][$key]['required'] = $requirement->required ? 1 : 0;
                $response['requirements_main'][$key]['name'] = $requirement->name;
                $response['requirements_main'][$key]['field'] = $requirement->field;
            }
        }

        if (!$this->requirements_contacts()->isEmpty()) {
            foreach ($this->requirements_contacts() as $key => $requirement) {
                $response['requirements_contacts'][$key]['type'] = $requirement->type;
                $response['requirements_contacts'][$key]['required'] = $requirement->required ? 1 :0;
                $response['requirements_contacts'][$key]['name'] = $requirement->name;
                $response['requirements_contacts'][$key]['field'] = $requirement->field;
            }
        }

        if ($this->nationality->header_image != '')
            $nationality_header_image = url('storage/app/public/images/visa/' . $this->nationality->header_image);
        else
            $nationality_header_image = '';

        $response['nationality'] = [
            'id' => $this->nationality->id,
            'name' => $this->nationality->name,
            'nationality_header_image' => $nationality_header_image
        ];
        return $response;
    }
}
