<table class="table table-bordered table-hover table-striped">

    <thead>
        <tr>

            @foreach( $columns as $column):
        
            <th>@$column:</th>

            @endforeach:

        </tr>

    </thead>
    <tbody>
        @foreach( $result as $row ):
        <tr>
            <td>@implode('</td><td>', $row):</td>
        </tr>
        @endforeach:
    </tbody>
</table>
