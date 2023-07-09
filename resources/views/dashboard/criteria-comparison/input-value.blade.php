@extends('layouts.main')

@section('content')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Masukan Value Perbandingan Kriteria</h1>
  </div>

  <div class="table-responsive col-lg-12">
    <div class="d-lg-flex justify-content-end gap-2">
      <a href="/dashboard/criteria-comparisons" class="btn btn-secondary mb-3">
        <span data-feather="arrow-left"></span>
        Kembali Ke Perbandingan Data
      </a>

      @if ($isDoneCounting)
      <a href="/dashboard/criteria-comparisons/result/{{ $criteria_analysis->id }}" class="btn btn-success mb-3 ml-4">
        <span data-feather="clipboard"></span>
        Lihat Hasil Perbandingan
      </a>
      @endif
    </div>

    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col" class="text-center">Kriteria Pertama</th>
          <th scope="col" class="text-center">Value</th>
          <th scope="col" class="text-center">Kriteria Kedua</th>
          <th scope="col" colspan="2"></th>
        </tr>
      </thead>
      <tbody>
        @if (count($details))
          <form action="/dashboard/criteria-comparisons/{{ $details[0]->criteria_analysis_id }}" method="POST">
            @method('put')
            @csrf

            <input type="hidden" name="id" value="{{ $details[0]->criteria_analysis_id }}">
            @foreach ($details as $detail)
              <tr>
                <input type="hidden" name="criteria_analysis_detail_id[]" value="{{ $detail->id }}">

                <td class="text-center">
                  {{ $detail->firstCriteria->name }}
                </td>
                <td class="text-center">
                  <select class="form-select" name="comparison_values[]" required>
                    <option value="" disabled selected>--Choose Value--</option>
                    <option value="1" {{ $detail->comparison_value == 1 ? 'selected' : '' }}>
                      1 - Sangat Kurang
                    </option>
                    
                    <option value="3" {{ $detail->comparison_value == 3 ? 'selected' : '' }}>
                      3 - Kurang
                    </option>
                    
                    <option value="5" {{ $detail->comparison_value == 5 ? 'selected' : '' }}>
                      5 - Cukup
                    </option>
                    
                    <option value="7" {{ $detail->comparison_value == 7 ? 'selected' : '' }}>
                      7 - Prioritas
                    </option>
                    
                    </option>
                    <option value="9" {{ $detail->comparison_value == 9 ? 'selected' : '' }}>
                      9 - Sangat Prioritas
                    </option>
                  </select>
                </td>
                <td class="text-center">
                  {{ $detail->secondCriteria->name }}
                </td>
              </tr>
            @endforeach
            @can('update', $criteria_analysis)
              <tr>
                <td class="text-center">
                  <button type="submit" class="btn btn-primary">Simpan</button>
                </td>
              </tr>
            @endcan
          </form>
        @endif
      </tbody>
    </table>
  </div>
@endsection