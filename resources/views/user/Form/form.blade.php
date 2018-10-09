@extends('layouts.app')

@section('content')

@endsection
@section('style')
    <form id="registerForm" action="">

        <h1>Schrijf je hier in:</h1>

        <!-- One "tab" for each step in the form: -->
        <div class="tab">Kies je reis:
            <p><select name="reizen">
                    <option></option>
                </select></p>
        </div>

        <div class="tab">Persoonlijke gegevens:
            <p><<input oninput="this.className = ''"></p>
            <p><input placeholder="Phone..." oninput="this.className = ''"></p>
        </div>

        <div class="tab">Contact gegevens:
            <p><input placeholder="dd" oninput="this.className = ''"></p>
            <p><input placeholder="mm" oninput="this.className = ''"></p>
            <p><input placeholder="yyyy" oninput="this.className = ''"></p>
        </div>

        <div class="tab">Medische gegevens:
            <p><input placeholder="Username..." oninput="this.className = ''"></p>
            <p><input placeholder="Password..." oninput="this.className = ''"></p>
        </div>

        <div class="tab">Confirmatie:
            <p><input placeholder="Username..." oninput="this.className = ''"></p>
            <p><input placeholder="Password..." oninput="this.className = ''"></p>
        </div>

        <div style="overflow:auto;">
            <div style="float:right;">
                <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
            </div>
        </div>

        <!-- Circles which indicates the steps of the form: -->
        <div style="text-align:center;margin-top:40px;">
            <span class="step"></span>
            <span class="step"></span>
            <span class="step"></span>
            <span class="step"></span>
            <span class="step"></span>

        </div>

    </form>
@endsection