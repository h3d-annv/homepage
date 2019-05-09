@extends('layouts.app')
@foreach($products as $key)
    <tr role="row" class="odd">
        <td>{{ HTML::image(asset("uploads/" . $key->image),'', array('width' => 200)) }}</td>
        <td>{{ $key->title_vi }}</td>
        <td>{{ $key->title_en }}</td>
        <td>{{ $key->slug }}</td>
    </tr>
    <br>
@endforeach