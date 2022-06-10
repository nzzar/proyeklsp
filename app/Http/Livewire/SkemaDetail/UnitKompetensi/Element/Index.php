<?php

namespace App\Http\Livewire\SkemaDetail\UnitKompetensi\Element;

use App\Models\Element;
use App\Models\UnjukKerja;
use Exception;
use Livewire\Component;

class Index extends Component
{
    public $unitId;
    public $elementId;
    public $element;

    public $unjukId;
    public $unjuk;

    public $isDelete = false;

    protected $listeners = [
        'get-element-id' => 'getElementById',
        'delete-element' => 'deleteElement',
        'get-unjuk-kerja-id' => 'getUnjukKerjaId',
        'delete-unjuk-kerja' => 'deleteUnjukKerja'
    ];

    public function mount($unitId)
    {
        $this->unitId = $unitId;
    }

    public function render()
    {
        $data = Element::where('unit_kompetensi_id', $this->unitId)->get();

        $unjukKerja = UnjukKerja::where('element_id', $this->elementId)->get();

        return view('livewire.skema-detail.unit-kompetensi.element.index', compact('data', 'unjukKerja'));
    }

    public function setElementId($elementId)
    {
        $this->elementId = $elementId;
    }

    public function createElement()
    {
        $this->validate([
            'element' => 'required',
        ]);

        $data = new Element();
        $data->unit_kompetensi_id = $this->unitId;
        $data->name = $this->element;
        $data->save();

        $this->element = null;

        $this->emit('success-create-element');
    }

    public function getElementById($elementId, $isDelete)
    {

        $this->isDelete = $isDelete;
        try {
            $data = Element::findOrFail($elementId);
            $this->elementId = $data->id;
            $this->element = $data->name;

            $this->emit('success-set-element', $data, $this->isDelete);
        } catch (Exception $e) {
            $this->emit('error-get-element-by-id', ['message' => 'element not found']);
        }
    }

    public function updateElement()
    {
        $this->validate([
            'element' => 'required'
        ]);

        $data = Element::findOrFail($this->elementId);
        $data->name = $this->element;
        $data->save();

        $this->emit('success-update-element');
    }

    public function deleteElement()
    {
        $data = Element::findOrFail($this->elementId);
        $data->delete();
        $this->elementId = null;
        $this->isDelete = false;

        $this->emit('success-delete-element');
    }

    public function createUnjukKerja()
    {
        $this->validate(
            [
                'unjuk' => 'required',
            ],
            [],
            [
                'unjuk' => 'Unjuk Kerja'
            ]
        );

        $data = new UnjukKerja();
        $data->element_id = $this->elementId;
        $data->description = $this->unjuk;
        $data->save();

        $this->unjuk = null;
    }

    public function getUnjukKerjaId($id, $isDelete) {
        $this->isDelete = $isDelete;
        
        try {
            $data = UnjukKerja::findOrFail($id);
            $this->unjukId = $data->id;
            $this->unjuk = $data->description;
            $this->emit('success-set-unjuk-kerja', $data, $this->isDelete);

        } catch (Exception $e) {
            $this->emit('error-set-unjuk-kerja', 'Data tidak ditemukan');
        }
    }

    public function updateUnjukKerja() {
        $this->validate(
            [
                'unjuk' => 'required',
            ],
            [],
            [
                'unjuk' => 'Unjuk Kerja'
            ]
        );

        $data = UnjukKerja::findOrFail($this->unjukId);
        $data->element_id = $this->elementId;
        $data->description = $this->unjuk;
        $data->save();

        $this->unjuk = null;
    }

    public function deleteUnjukKerja() {

        $data = UnjukKerja::findOrFail($this->unjukId);
        $data->delete();
        $this->unjukId = null;

        $this->emit('success-delete-unjuk-kerja');
    }


}
