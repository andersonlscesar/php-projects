<tr>
    <th scope="row">{{ $contact['id'] }}</th>
    <td>{{ $contact['name'] }}</td>
    <td>{{ $contact['phone']}}</td>
    <td></td>
    <td></td>
  
    <td>
    <a href="{{ route('contacts.show', $contact['id']) }}" class="btn btn-sm btn-circle btn-outline-info" title="Show"><i class="fa fa-eye"></i></a>
    <a href="form.html" class="btn btn-sm btn-circle btn-outline-secondary" title="Edit"><i class="fa fa-edit"></i></a>
    <a href="#" class="btn btn-sm btn-circle btn-outline-danger" title="Delete" onclick="confirm('Are you sure?')"><i class="fa fa-times"></i></a>
    </td>
</tr>   