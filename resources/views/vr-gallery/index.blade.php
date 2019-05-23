@extends('layouts.app')
@foreach($vr_gallery as $image)
    <tr role="row" class="odd">
        <td><a href="{{ $image->link }}" target="_blank">{{ HTML::image(asset("uploads/" . $image->image),'', array('width' => 200)) }}</a></td>
        <td><a href="{{ $image->link }}" target="_blank">{{ $image->link }}</a></td>
    </tr>
    <br>
@endforeach