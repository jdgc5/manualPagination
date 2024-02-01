@extends ('app.base')
@section('title', 'Argo App Settings')

@section ('content')

        <select required name="pais" class="form-select" id="pais">
            <option hidden value="">Selecciona el pais</option>
            @foreach ($paises as $value => $label)
                <option value="{{ $value }}" {{$pais == $value ? 'selected': ''}}>{{ $label }}</option>
            @endforeach
        </select>
        <br>
        <select required name="provincia" class="form-select" id="provincia">
            <option disabled value="$nbsp;" {{$provincia == '' ? 'selected': ''}}>Selecciona la provincia</option>
            @foreach ($provincias as $value => $label)
                <option value="{{ $value }}">{{ $label }}</option>
            @endforeach
        </select>
        <br>
        <select required name="country" class="form-select" id="country">
            <option disabled value="" {{$selectedCountry == '' ? 'selected': ''}}>Select your country</option>
            @foreach ($countries as $country)
                <option value="{{ $country->code }}" {{$selectedCountry == $country->code ? 'selected': ''}}>{{ country->name }}</option>
            @endforeach
        </select>
        <br>
        <select required name="country" class="form-select" id="countryv2">
            <option disabled value="" {{$selectedCountry == '' ? 'selected': ''}}>Select your country</option>
            @foreach ($countries as $country)
                <option value="{{ $country->code }}" {{$selectedCountry == $country->code ? 'selected': ''}}>{{ country->name }}</option>
            @endforeach
        </select>
        <br>
        <select required name="country" class="form-select" id="countryv3">
            <option disabled value="" {{$selectedCountry2 == '' ? 'selected': ''}}>Select your country</option>
            @foreach ($countries2 as $value => $label)
                <option value="{{ $value }}" {{$selectedCountry2 == value ? 'selected': ''}}>{{ $label }}</option>
            @endforeach
        </select>
        <br>
        
    
@endsection