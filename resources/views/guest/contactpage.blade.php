/**
 * Created by PhpStorm.
 * User: kaana
 * Date: 15/11/2018
 * Time: 9:36
 */
@extends('layouts.app')

@section('content')
    <div class="content-center">
        <form>
            <label for="onderwerp">Onderwerp :</label>
            <input type="text" id="onderwerp" name="onderwerp"><br>
            <label for="bericht">Bericht: </label>
            <textarea name="bericht" id="bericht"></textarea>
            <input type="submit" value="Verzend">
        </form>
    </div>
@endsection