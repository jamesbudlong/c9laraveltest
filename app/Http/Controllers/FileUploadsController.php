<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\FileUpload;
use Illuminate\Support\Str;
use File;
use Exception;

class FileUploadsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(!auth()->user()->hasPermissionTo('view-all-file-upload'))
        {
            abort(403, 'User cannot perform this action.');
        }

        $data = FileUpload::orderBy('id','DESC')->paginate(5);

        return view('file_uploads.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!auth()->user()->hasPermissionTo('create-file-upload'))
        {
            abort(403, 'User cannot perform this action.');
        }

        return view('file_uploads.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!auth()->user()->hasPermissionTo('create-file-upload'))
        {
            abort(403, 'User cannot perform this action.');
        }

        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'uploaded_file' => 'required|max:10000'
        ]);

        $input = $request->all();

        //Get file details
        $file_name = $request->file('uploaded_file')->getClientOriginalName();
        $file_path = $request->file('uploaded_file')->getPathName();
        $file_extension = $request->file('uploaded_file')->extension();

        $full_path = $file_path . '/' . $file_name;

        try {
            //Save file first to public storage since we cannot encode a temp file to base64
            $request->file('uploaded_file')->move(public_path('storage/app/public/images'), $file_name);
            $data = file_get_contents(public_path('storage/app/public/images/') . $file_name);

            //Get the mime_content_type to determine what files we encoding
            $mime_content_type = mime_content_type(public_path('storage/app/public/images/') . $file_name);

            //Encode file to base64
            $base64 = 'data:' . $mime_content_type . ';base64,' . base64_encode($data);

            //Save to database
            $input['encoded_file'] = $base64;
            $input['file_name'] = $file_name;
            $input['file_extension'] = $file_extension;

            $file_upload = FileUpload::create($input);

            //Delete the saved file from storage since we already encoded the file and saved to database
            File::delete(public_path('storage/app/public/images/') . $file_name);

        }
        catch (Exception $e) {
            return redirect()->route('file_uploads.create')
                        ->with('error', 'Something went wrong. Error: ' . $e->getMessage());
        }

        return redirect()->route('file_uploads.create')
                        ->with('success','File uploaded successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $file_upload = FileUpload::find($id);
        // return view('file_uploads.show',compact('file_upload'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!auth()->user()->hasPermissionTo('update-file-upload'))
        {
            abort(403, 'User cannot perform this action.');
        }

        $file_upload = FileUpload::find($id);
        $encoded = $file_upload->encoded_file;

        return view('file_uploads.edit',compact('file_upload'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(!auth()->user()->hasPermissionTo('update-file-upload'))
        {
            abort(403, 'User cannot perform this action.');
        }

        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'uploaded_file' => 'sometimes|max:10000'
        ]);

        $input = $request->all();

        try {
            //Need to check first if update includes the file or just the text fields
            if($request->uploaded_file){
                //Get file details
                $file_name = $request->file('uploaded_file')->getClientOriginalName();
                $file_path = $request->file('uploaded_file')->getPathName();
                $file_extension = $request->file('uploaded_file')->extension();

                $full_path = $file_path . '/' . $file_name;

                //Save file first to public storage since we cannot encode a temp file to base64
                $request->file('uploaded_file')->move(public_path('storage/app/public/images'), $file_name);
                $data = file_get_contents(public_path('storage/app/public/images/') . $file_name);

                //Get the mime_content_type to determine what files we encoding
                $mime_content_type = mime_content_type(public_path('storage/app/public/images/') . $file_name);

                //Encode file to base64
                $base64 = 'data:' . $mime_content_type . ';base64,' . base64_encode($data);

                $input['encoded_file'] = $base64;
                $input['file_name'] = $file_name;
                $input['file_extension'] = $file_extension;

                //Save to database
                $file_upload = FileUpload::find($id);
                $file_upload->update($input);

                //Delete the saved file from storage since we already encoded the file and saved to database
                File::delete(public_path('storage/app/public/images/') . $file_name);
            }
            else{
                //Save to database
                $file_upload = FileUpload::find($id);
                $file_upload->update($input);
            }
        }
        catch (Exception $e) {
            return redirect()->route('file_uploads.edit', $id)
                        ->with('error', 'Something went wrong. Error: ' . $e->getMessage());
        }

        return redirect()->route('file_uploads.index')
                        ->with('success','File updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!auth()->user()->hasPermissionTo('delete-file-upload'))
        {
            abort(403, 'User cannot perform this action.');
        }

        FileUpload::find($id)->delete();
        return redirect()->route('file_uploads.index')
                        ->with('success','File deleted successfully');
    }
}
