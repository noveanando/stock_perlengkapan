<div class="page-header page-header-default">
	<div class="page-header-content">
		<div class="page-title">
			<h4><i class="{{ getAttributPage($menu, request()->route()->getName(),'icon') }} position-left"></i> <span class="text-semibold">{{ getAttributPage($menu, request()->route()->getName(),'label') }}</span></h4>
		</div>
	</div>
</div>
<div class="content" >
	<div class="panel panel-flat">
		<div class="panel-heading">
			<h5 class="panel-title">{{$data ? 'Edit' : 'Tambah'}} {{ getAttributPage($menu, request()->route()->getName(),'label') }}</h5>
		</div>
		<div class="panel-body">
			<form class="form-horizontal post-action" action="{{ route('role-save',id_exist($data)) }}" method="post">
				<div class="row">
					<div class="col-md-10">
						<div class="row">
							<div class="col-md-6">
								<div class="row">
									<label class="col-md-4 control-label">Nama Peran <span class="required">*</span></label>
									<div class="col-md-8 form-group">
										<input type="text" name="role_name" value="{{ val_exist($data,'role_name') }}" class="form-control">
									</div>
								</div>
								<div class="row">
									<label class="col-md-4 control-label">Status <span class="required">*</span></label>
									<div class="col-md-5 form-group ">
										<select class="form-control" name="status">
											<option value="1" {{ val_exist($data,'status') == '1' ? 'selected' : ''}}>Aktif</option>
											<option value="0" {{ val_exist($data,'status') == '0' ? 'selected' : ''}}>Tidak Aktif</option>
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<label class="col-md-2 control-label">Akses Halaman</label>
						</div>		
					</div>
					<div class="col-md-2">
						<button type="submit" class="btn btn-primary btn-block"><i class="icon-floppy-disk position-left"></i> Simpan</button>
						<a href="{{ route('role') }}" class="btn btn-default me btn-block"> <i class="icon-undo2 position-left"></i> Kembali</a>
					</div>
				</div>
				<div class="table-responsive" style="margin-top: 10px;">
					<table class="table">
						<tr>
							<th>Menu</th>
							<th>Read</th>
							<th>Create</th>
							<th>Edit</th>
							<th>Delete</th>
							<th>Export</th>
							<th>Import</th>
							<th>Lain-Lain</th>
						</tr>
						@foreach(getMenu(true) as $key => $menu)
						@if($menu['route'] != 'newsection')
						@if(sizeof($menu['submenu']) > 0)
						@foreach($menu['submenu'] as $submenu)
						<tr>
							<td>{{ $submenu['label'] }}</td>
							<td>
								@if(in_array('read',$submenu['activity']))
								<input type="checkbox" name="rules[{{$submenu['route']}}][read]" {{ checkbox_exist(val_exist($data,'rules',[]),$submenu['route'],'read') }}>
								@endif
							</td>
							<td>
								@if(in_array('create',$submenu['activity']))
								<input type="checkbox" name="rules[{{$submenu['route']}}][create]" {{ checkbox_exist(val_exist($data,'rules',[]),$submenu['route'],'create') }}>
								@endif
							</td>
							<td>
								@if(in_array('edit',$submenu['activity']))
								<input type="checkbox" name="rules[{{$submenu['route']}}][edit]" {{ checkbox_exist(val_exist($data,'rules',[]),$submenu['route'],'edit') }}>
								@endif
							</td>
							<td>
								@if(in_array('delete',$submenu['activity']))
								<input type="checkbox" name="rules[{{$submenu['route']}}][delete]" {{ checkbox_exist(val_exist($data,'rules',[]),$submenu['route'],'delete') }}>
								@endif
							</td>
							<td>
								@if(in_array('export',$submenu['activity']))
								<input type="checkbox" name="rules[{{$submenu['route']}}][export]" {{ checkbox_exist(val_exist($data,'rules',[]),$submenu['route'],'export') }}>
								@endif
							</td>
							<td>
								@if(in_array('import',$submenu['activity']))
								<input type="checkbox" name="rules[{{$submenu['route']}}][import]" {{ checkbox_exist(val_exist($data,'rules',[]),$submenu['route'],'import') }}>
								@endif
							</td>
							<td>
								@foreach(array_diff($submenu['activity'],$exist_column) as $other)
								<input type="checkbox" name="rules[{{$submenu['route']}}][{{$other}}]" {{ checkbox_array_exist(val_exist($data,'rules',[]),$submenu['route'],'other',$other) }}> {{$other}}<br>
								@endforeach
							</td>
						</tr>
						@endforeach
						@else
						<tr>
							<td>{{ $menu['label'] }}</td>
							<td>
								@if(in_array('read',$menu['activity']))
								<input type="checkbox" name="rules[{{$menu['route']}}][read]" {{ checkbox_exist(val_exist($data,'rules',[]),$menu['route'],'read') }}>
								@endif
							</td>
							<td>
								@if(in_array('create',$menu['activity']))
								<input type="checkbox" name="rules[{{$menu['route']}}][create]" {{ checkbox_exist(val_exist($data,'rules',[]),$menu['route'],'create') }}>
								@endif
							</td>
							<td>
								@if(in_array('edit',$menu['activity']))
								<input type="checkbox" name="rules[{{$menu['route']}}][edit]" {{ checkbox_exist(val_exist($data,'rules',[]),$menu['route'],'edit') }}>
								@endif
							</td>
							<td>
								@if(in_array('delete',$menu['activity']))
								<input type="checkbox" name="rules[{{$menu['route']}}][delete]" {{ checkbox_exist(val_exist($data,'rules',[]),$menu['route'],'delete') }}>
								@endif
							</td>
							<td>
								@if(in_array('export',$menu['activity']))
								<input type="checkbox" name="rules[{{$menu['route']}}][export]" {{ checkbox_exist(val_exist($data,'rules',[]),$menu['route'],'export') }}>
								@endif
							</td>
							<td>
								@if(in_array('import',$menu['activity']))
								<input type="checkbox" name="rules[{{$menu['route']}}][import]" {{ checkbox_exist(val_exist($data,'rules',[]),$menu['route'],'import') }}>
								@endif
							</td>
							<td>
								@foreach(array_diff($menu['activity'],$exist_column) as $other)
								<input type="checkbox" name="rules[{{$menu['route']}}][{{$other}}]" {{ checkbox_array_exist(val_exist($data,'rules',[]),$menu['route'],'other',$other) }}> {{$other}}<br>
								@endforeach
							</td>
						</tr>
						@endif
						@endif
						@endforeach
					</table>				
				</div>
			</form>
		</div>
	</div>
</div>
