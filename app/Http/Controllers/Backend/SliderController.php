<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Model\Slider;

class SliderController extends Controller
{
    public function view(){     
        $data['allData'] = Slider::all();
        
        return view('backend.slider.view-slider', $data);
    }

    public function add(){
    
        return view('backend.slider.add-slider');
    }

    public function store(Request $request){
        $data = new Slider();

        $data->short_title = $request->short_title;
        $data->long_title = $request->long_title;
        $data->created_by = Auth::user()->id;

        if($request->file('image')){
            $file = $request->file('image');
            $fileName = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/slider_images'), $fileName);
            $data['image'] = $fileName;

        }
        $data->save();

        return redirect()->route('sliders.view')->with('success', 'Slider inserted successfully');
    }

    public function edit($id){
        $editData = Slider::find($id);

        return view('backend.slider.edit-slider', compact('editData'));
    }

    public function update(Request $request, $id){
        $data = Slider::find($id);

        $data->short_title = $request->short_title;
        $data->long_title = $request->long_title;
        $data->updated_by = Auth::user()->id;

        if($request->file('image')){
            $file = $request->file('image');
            @unlink(public_path('upload/slider_images/'.$data->image));
            $fileName = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/slider_images'), $fileName);
            $data['image'] = $fileName;

        }
        $data->save();

        return redirect()->route('sliders.view')->with('success', 'Data updated successfully');

    }

    public function delete($id){
        $slider = Slider::find($id);
        if(file_exists('public/upload/slider_images/' . $slider->image) AND ! empty($slider->image)){
            unlink('public/upload/slider_images/' . $slider->image);
        }
        $slider->delete();

        return redirect()->route('sliders.view')->with('success', 'Data deleted successfully');
    }
}
