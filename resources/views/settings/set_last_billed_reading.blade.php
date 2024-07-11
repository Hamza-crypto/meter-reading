<!-- resources/views/settings/set_last_billed_reading.blade.php -->

@extends('layouts.app') <!-- Extend your main layout or base template -->

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Set Last Billed Reading</div>
                    <div class="card-body">
                        <form action="{{ route('set-last-billed-reading') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="meter_name">Meter Name:</label>
                                <select id="meter_name" name="meter_name" class="form-control" required>
                                    <option value="meter1">Meter 1</option>
                                    <option value="meter2">Meter 2</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="last_billed_reading">Last Billed Reading:</label>
                                <input type="number" id="last_billed_reading" name="last_billed_reading"
                                    class="form-control" step="0.01" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
