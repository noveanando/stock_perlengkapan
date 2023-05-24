<div class="page-header page-header-default">
	<div class="page-header-content">
		<div class="page-title">
			<h4><i class="{{ getAttributPage($menu, request()->route()->getName(),'icon') }} position-left"></i> <span class="text-semibold">{{ getAttributPage($menu, request()->route()->getName(),'label') }}</span></h4>
		</div>
	</div>
</div>
<div class="content" >
	<div class="panel panel-flat">
		<div class="panel-body">
			<form class="form-horizontal post-action" action="{{ route('import-excel-save') }}" method="post" enctype="multipart/form-data">
				<div class="row">
					<label class="col-md-2 control-label">Label </label>
					<div class="col-md-3 form-group">
						<select name="label" class="form-control">
                            @foreach($labels as $label)
                            <option value="{{$label}}">{{$label}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <input type="file" class="form-control" name="file_excel">
                    </div>
				</div>
				
				<div class="pull-right">
					<button type="submit" class="btn btn-primary"><i class="icon-floppy-disk position-left"></i> Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>

