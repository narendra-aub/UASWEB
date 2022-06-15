<div class="container">
<h3>Daftar Gudang</h3>
	<table>
	<tr>
		<td></td><td></td>
		<td>NAMA</td><td></td>
		<td>JURUSAN</td><td></td>
		<td>ALAMAT</td><td></td>
		<td><a href="{{ url('mahasiswa/create') }}">Tambah Data</a></td>
	</tr>
	@foreach($rows as $row)
	<tr>
		<td>{{ $row->kode_stock }}</td><td></td>
		<td>{{ $row->nama_stock }}</td><td></td>
		<td>{{ $row->jumlah_stock }}</td><td></td>
		<td>{{ $row->satuan_stock }}</td><td></td>
		<td><a href="{{ url('mahasiswa/' . $row->mhsw_id . '/edit') }}">Edit</a></td>
		<td>
			<form action="{{ url('mahasiswa/' . $row->mhsw_id) }}" method="POST">
			<input name="_method" type="hidden" value="DELETE">
			@csrf
			<button>Hapus</button>
			</form>			
		</td>
	</tr>
	@endforeach
	</table>
</div>