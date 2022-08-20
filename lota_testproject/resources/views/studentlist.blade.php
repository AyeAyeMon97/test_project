@foreach($stutents as $stutent)
    <tr>
        <td>{{ $stutent->name }}</td>
        <td>{{ $stutent->email }}</td>
        <td><a href='#' class='btn btn-success edit' data-id='{{ $stutent->id }}' data-first='{{ $stutent->name }}' data-last='{{ $stutent->email }}'> Edit</a>
            <a href='#' class='btn btn-danger delete' data-id='{{ $stutent->id }}'> Delete</a>
        </td>
    </tr>
@endforeach
