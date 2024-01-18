<table class="table" cellpadding="15" width="100%" style="table-layout: fixed; text-align:justify;">
    <tr>
@foreach ($getRecord()->application->values as $key=>$value)
        <td>{{$key}}</td>
@endforeach
</tr>
<tr>
    @foreach ($getRecord()->application->values as $item)
    <td>
        @php
            $imageExtensions = ['jpg', 'jpeg', 'gif', 'png', 'bmp', 'svg', 'svgz', 'cgm', 'djv', 'djvu', 'ico', 'ief','jpe', 'pbm', 'pgm', 'pnm', 'ppm', 'ras', 'rgb', 'tif', 'tiff', 'wbmp', 'xbm', 'xpm', 'xwd'];
            $srcPath="/storage/$item";
            $explodeImage = explode('.', $srcPath);
            $extension = end($explodeImage);
            //
            $filePath=public_path("/storage/$item");
        @endphp
        @if (file_exists($filePath))
            @if (in_array($extension, $imageExtensions))
            <a href="/storage/{{$item}}" target="_blank">
                <img src="/storage/{{$item}}" alt="" width="100" height="100">
            </a>
            @else
                <a href="/storage/{{$item}}" target="_blank"><ins>تصفح الملف</ins></a>
            @endif
        @else
            {{$item}} 
        @endif
    </td>
    @endforeach
</tr>
</table>