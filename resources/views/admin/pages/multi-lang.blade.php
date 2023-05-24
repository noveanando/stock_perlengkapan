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
            <div class="text-right">
                <select name="set_lang" class="form-control" style="max-width:100px;display:unset;">
                    <option value="en" selected>EN</option>
                    <option value="id">ID</option>
                </select>
            </div>
			<form class="form-horizontal post-action" action="{{ route('multi-lang-save') }}" method="post">
				<label for="" class="text-bold">Halaman Login</label>
				<div class="row">
					<label class="col-md-2 control-label">Judul Login </label>
					<div class="col-md-5 form-group">
						<input type="text" name="title_login[en]" value="{{ valLangExist($data,'title_login','en') }}" class="form-control en">
                        <input type="text" name="title_login[id]" value="{{ valLangExist($data,'title_login','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Konten 1 </label>
					<div class="col-md-5 form-group">
						<input type="text" name="content_1_login[en]" value="{{ valLangExist($data,'content_1_login','en') }}" class="form-control en">
                        <input type="text" name="content_1_login[id]" value="{{ valLangExist($data,'content_1_login','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Konten 2 </label>
					<div class="col-md-5 form-group">
						<input type="text" name="content_2_login[en]" value="{{ valLangExist($data,'content_2_login','en') }}" class="form-control en">
                        <input type="text" name="content_2_login[id]" value="{{ valLangExist($data,'content_2_login','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Username </label>
					<div class="col-md-5 form-group">
						<input type="text" name="username[en]" value="{{ valLangExist($data,'username','en') }}" class="form-control en">
                        <input type="text" name="username[id]" value="{{ valLangExist($data,'username','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Password </label>
					<div class="col-md-5 form-group">
						<input type="text" name="password[en]" value="{{ valLangExist($data,'password','en') }}" class="form-control en">
                        <input type="text" name="password[id]" value="{{ valLangExist($data,'password','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Masuk </label>
					<div class="col-md-5 form-group">
						<input type="text" name="login[en]" value="{{ valLangExist($data,'login','en') }}" class="form-control en">
                        <input type="text" name="login[id]" value="{{ valLangExist($data,'login','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Disclaimer </label>
					<div class="col-md-5 form-group">
						<input type="text" name="disclaimer[en]" value="{{ valLangExist($data,'disclaimer','en') }}" class="form-control en">
                        <input type="text" name="disclaimer[id]" value="{{ valLangExist($data,'disclaimer','id') }}" class="form-control id">
					</div>
				</div>
				<hr>
				<label for="" class="text-bold">Halaman Utama</label>
				<div class="row">
					<label class="col-md-2 control-label">Bahasa </label>
					<div class="col-md-5 form-group">
						<input type="text" name="language[en]" value="{{ valLangExist($data,'language','en') }}" class="form-control en">
                        <input type="text" name="language[id]" value="{{ valLangExist($data,'language','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Keluar </label>
					<div class="col-md-5 form-group">
						<input type="text" name="logout[en]" value="{{ valLangExist($data,'logout','en') }}" class="form-control en">
                        <input type="text" name="logout[id]" value="{{ valLangExist($data,'logout','id') }}" class="form-control id">
					</div>
				</div>
                <div class="row">
					<label class="col-md-2 control-label">Selamat Datang </label>
					<div class="col-md-5 form-group">
						<textarea name="welcome[en]" rows="3" class="form-control en">{{ valLangExist($data,'welcome','en') }}</textarea>
						<textarea name="welcome[id]" rows="3" class="form-control id">{{ valLangExist($data,'welcome','id') }}</textarea>
					</div>
				</div>
                <div class="row">
					<label class="col-md-2 control-label">Tombol Isi Data Diri </label>
					<div class="col-md-5 form-group">
						<input type="text" name="btn_info_form[en]" value="{{ valLangExist($data,'btn_info_form','en') }}" class="form-control en">
                        <input type="text" name="btn_info_form[id]" value="{{ valLangExist($data,'btn_info_form','id') }}" class="form-control id">
					</div>
				</div>
				<hr>
				<label for="" class="text-bold">Form Data Diri</label>
				<div class="row">
					<label class="col-md-2 control-label">Kelengkapan Input </label>
					<div class="col-md-5 form-group">
						<input type="text" name="completeness[en]" value="{{ valLangExist($data,'completeness','en') }}" class="form-control en">
                        <input type="text" name="completeness[id]" value="{{ valLangExist($data,'completeness','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Judul Form Data Diri</label>
					<div class="col-md-5 form-group">
						<input type="text" name="title_info_form[en]" value="{{ valLangExist($data,'title_info_form','en') }}" class="form-control en">
                        <input type="text" name="title_info_form[id]" value="{{ valLangExist($data,'title_info_form','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Posisi Dilamar </label>
					<div class="col-md-5 form-group">
						<input type="text" name="applied_position[en]" value="{{ valLangExist($data,'applied_position','en') }}" class="form-control en">
                        <input type="text" name="applied_position[id]" value="{{ valLangExist($data,'applied_position','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Tanggal </label>
					<div class="col-md-5 form-group">
						<input type="text" name="date[en]" value="{{ valLangExist($data,'date','en') }}" class="form-control en">
                        <input type="text" name="date[id]" value="{{ valLangExist($data,'date','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Identitas Diri </label>
					<div class="col-md-5 form-group">
						<input type="text" name="personal_identity[en]" value="{{ valLangExist($data,'personal_identity','en') }}" class="form-control en">
                        <input type="text" name="personal_identity[id]" value="{{ valLangExist($data,'personal_identity','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Nama Lengkap </label>
					<div class="col-md-5 form-group">
						<input type="text" name="full_name[en]" value="{{ valLangExist($data,'full_name','en') }}" class="form-control en">
                        <input type="text" name="full_name[id]" value="{{ valLangExist($data,'full_name','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Nama Panggilan </label>
					<div class="col-md-5 form-group">
						<input type="text" name="nickname[en]" value="{{ valLangExist($data,'nickname','en') }}" class="form-control en">
                        <input type="text" name="nickname[id]" value="{{ valLangExist($data,'nickname','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Tempat, Tanggal Lahir </label>
					<div class="col-md-5 form-group">
						<input type="text" name="place_n_date[en]" value="{{ valLangExist($data,'place_n_date','en') }}" class="form-control en">
                        <input type="text" name="place_n_date[id]" value="{{ valLangExist($data,'place_n_date','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Agama </label>
					<div class="col-md-5 form-group">
						<input type="text" name="religion[en]" value="{{ valLangExist($data,'religion','en') }}" class="form-control en">
                        <input type="text" name="religion[id]" value="{{ valLangExist($data,'religion','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Islam </label>
					<div class="col-md-5 form-group">
						<input type="text" name="moeslem[en]" value="{{ valLangExist($data,'moeslem','en') }}" class="form-control en">
                        <input type="text" name="moeslem[id]" value="{{ valLangExist($data,'moeslem','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Kristen </label>
					<div class="col-md-5 form-group">
						<input type="text" name="christian[en]" value="{{ valLangExist($data,'christian','en') }}" class="form-control en">
                        <input type="text" name="christian[id]" value="{{ valLangExist($data,'christian','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Katolik </label>
					<div class="col-md-5 form-group">
						<input type="text" name="catholic[en]" value="{{ valLangExist($data,'catholic','en') }}" class="form-control en">
                        <input type="text" name="catholic[id]" value="{{ valLangExist($data,'catholic','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Budha </label>
					<div class="col-md-5 form-group">
						<input type="text" name="buddhist[en]" value="{{ valLangExist($data,'buddhist','en') }}" class="form-control en">
                        <input type="text" name="buddhist[id]" value="{{ valLangExist($data,'buddhist','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Hindu </label>
					<div class="col-md-5 form-group">
						<input type="text" name="hindu[en]" value="{{ valLangExist($data,'hindu','en') }}" class="form-control en">
                        <input type="text" name="hindu[id]" value="{{ valLangExist($data,'hindu','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Konghucu </label>
					<div class="col-md-5 form-group">
						<input type="text" name="confucius[en]" value="{{ valLangExist($data,'confucius','en') }}" class="form-control en">
                        <input type="text" name="confucius[id]" value="{{ valLangExist($data,'confucius','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Lainnya </label>
					<div class="col-md-5 form-group">
						<input type="text" name="other[en]" value="{{ valLangExist($data,'other','en') }}" class="form-control en">
                        <input type="text" name="other[id]" value="{{ valLangExist($data,'other','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Jenis Kelamin </label>
					<div class="col-md-5 form-group">
						<input type="text" name="gender[en]" value="{{ valLangExist($data,'gender','en') }}" class="form-control en">
                        <input type="text" name="gender[id]" value="{{ valLangExist($data,'gender','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Laki Laki </label>
					<div class="col-md-5 form-group">
						<input type="text" name="male[en]" value="{{ valLangExist($data,'male','en') }}" class="form-control en">
                        <input type="text" name="male[id]" value="{{ valLangExist($data,'male','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Perempuan </label>
					<div class="col-md-5 form-group">
						<input type="text" name="female[en]" value="{{ valLangExist($data,'female','en') }}" class="form-control en">
                        <input type="text" name="female[id]" value="{{ valLangExist($data,'female','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Golongan Darah </label>
					<div class="col-md-5 form-group">
						<input type="text" name="blood_type[en]" value="{{ valLangExist($data,'blood_type','en') }}" class="form-control en">
                        <input type="text" name="blood_type[id]" value="{{ valLangExist($data,'blood_type','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Status Perkawinan </label>
					<div class="col-md-5 form-group">
						<input type="text" name="marital_status[en]" value="{{ valLangExist($data,'marital_status','en') }}" class="form-control en">
                        <input type="text" name="marital_status[id]" value="{{ valLangExist($data,'marital_status','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Lajang </label>
					<div class="col-md-5 form-group">
						<input type="text" name="single[en]" value="{{ valLangExist($data,'single','en') }}" class="form-control en">
                        <input type="text" name="single[id]" value="{{ valLangExist($data,'single','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Menikah </label>
					<div class="col-md-5 form-group">
						<input type="text" name="married[en]" value="{{ valLangExist($data,'married','en') }}" class="form-control en">
                        <input type="text" name="married[id]" value="{{ valLangExist($data,'married','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Janda/Duda </label>
					<div class="col-md-5 form-group">
						<input type="text" name="widow_widower[en]" value="{{ valLangExist($data,'widow_widower','en') }}" class="form-control en">
                        <input type="text" name="widow_widower[id]" value="{{ valLangExist($data,'widow_widower','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Alamat </label>
					<div class="col-md-5 form-group">
						<input type="text" name="address[en]" value="{{ valLangExist($data,'address','en') }}" class="form-control en">
                        <input type="text" name="address[id]" value="{{ valLangExist($data,'address','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Kode Pos </label>
					<div class="col-md-5 form-group">
						<input type="text" name="postal_code[en]" value="{{ valLangExist($data,'postal_code','en') }}" class="form-control en">
                        <input type="text" name="postal_code[id]" value="{{ valLangExist($data,'postal_code','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Status Kepemilikan Rumah </label>
					<div class="col-md-5 form-group">
						<input type="text" name="ownership_status[en]" value="{{ valLangExist($data,'ownership_status','en') }}" class="form-control en">
                        <input type="text" name="ownership_status[id]" value="{{ valLangExist($data,'ownership_status','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Orang Tua </label>
					<div class="col-md-5 form-group">
						<input type="text" name="parent[en]" value="{{ valLangExist($data,'parent','en') }}" class="form-control en">
                        <input type="text" name="parent[id]" value="{{ valLangExist($data,'parent','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Sewa </label>
					<div class="col-md-5 form-group">
						<input type="text" name="rent[en]" value="{{ valLangExist($data,'rent','en') }}" class="form-control en">
                        <input type="text" name="rent[id]" value="{{ valLangExist($data,'rent','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Kos </label>
					<div class="col-md-5 form-group">
						<input type="text" name="boarding_house[en]" value="{{ valLangExist($data,'boarding_house','en') }}" class="form-control en">
                        <input type="text" name="boarding_house[id]" value="{{ valLangExist($data,'boarding_house','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Nomor Telepon </label>
					<div class="col-md-5 form-group">
						<input type="text" name="phone_number[en]" value="{{ valLangExist($data,'phone_number','en') }}" class="form-control en">
                        <input type="text" name="phone_number[id]" value="{{ valLangExist($data,'phone_number','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Telepon Rumah </label>
					<div class="col-md-5 form-group">
						<input type="text" name="home_phone[en]" value="{{ valLangExist($data,'home_phone','en') }}" class="form-control en">
                        <input type="text" name="home_phone[id]" value="{{ valLangExist($data,'home_phone','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Handphone </label>
					<div class="col-md-5 form-group">
						<input type="text" name="handphone[en]" value="{{ valLangExist($data,'handphone','en') }}" class="form-control en">
                        <input type="text" name="handphone[id]" value="{{ valLangExist($data,'handphone','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Handphone Lainnya</label>
					<div class="col-md-5 form-group">
						<input type="text" name="another_handphone[en]" value="{{ valLangExist($data,'another_handphone','en') }}" class="form-control en">
                        <input type="text" name="another_handphone[id]" value="{{ valLangExist($data,'another_handphone','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Email </label>
					<div class="col-md-5 form-group">
						<input type="text" name="email[en]" value="{{ valLangExist($data,'email','en') }}" class="form-control en">
                        <input type="text" name="email[id]" value="{{ valLangExist($data,'email','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Email Lainnya</label>
					<div class="col-md-5 form-group">
						<input type="text" name="another_email[en]" value="{{ valLangExist($data,'another_email','en') }}" class="form-control en">
                        <input type="text" name="another_email[id]" value="{{ valLangExist($data,'another_email','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Kontak Darurat</label>
					<div class="col-md-5 form-group">
						<input type="text" name="emergency_contact[en]" value="{{ valLangExist($data,'emergency_contact','en') }}" class="form-control en">
                        <input type="text" name="emergency_contact[id]" value="{{ valLangExist($data,'emergency_contact','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Nama</label>
					<div class="col-md-5 form-group">
						<input type="text" name="name[en]" value="{{ valLangExist($data,'name','en') }}" class="form-control en">
                        <input type="text" name="name[id]" value="{{ valLangExist($data,'name','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Hubungan</label>
					<div class="col-md-5 form-group">
						<input type="text" name="relationship[en]" value="{{ valLangExist($data,'relationship','en') }}" class="form-control en">
                        <input type="text" name="relationship[id]" value="{{ valLangExist($data,'relationship','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Kakak/Adik</label>
					<div class="col-md-5 form-group">
						<input type="text" name="brother_sister[en]" value="{{ valLangExist($data,'brother_sister','en') }}" class="form-control en">
                        <input type="text" name="brother_sister[id]" value="{{ valLangExist($data,'brother_sister','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Pendidikan</label>
					<div class="col-md-5 form-group">
						<input type="text" name="education[en]" value="{{ valLangExist($data,'education','en') }}" class="form-control en">
                        <input type="text" name="education[id]" value="{{ valLangExist($data,'education','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Tingkat Pendidikan</label>
					<div class="col-md-5 form-group">
						<input type="text" name="edu_background[en]" value="{{ valLangExist($data,'edu_background','en') }}" class="form-control en">
                        <input type="text" name="edu_background[id]" value="{{ valLangExist($data,'edu_background','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Nama Sekolah</label>
					<div class="col-md-5 form-group">
						<input type="text" name="institution[en]" value="{{ valLangExist($data,'institution','en') }}" class="form-control en">
                        <input type="text" name="institution[id]" value="{{ valLangExist($data,'institution','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Periode</label>
					<div class="col-md-5 form-group">
						<input type="text" name="period[en]" value="{{ valLangExist($data,'period','en') }}" class="form-control en">
                        <input type="text" name="period[id]" value="{{ valLangExist($data,'period','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">SMA</label>
					<div class="col-md-5 form-group">
						<input type="text" name="high_school[en]" value="{{ valLangExist($data,'high_school','en') }}" class="form-control en">
                        <input type="text" name="high_school[id]" value="{{ valLangExist($data,'high_school','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Diploma</label>
					<div class="col-md-5 form-group">
						<input type="text" name="academy_diploma[en]" value="{{ valLangExist($data,'academy_diploma','en') }}" class="form-control en">
                        <input type="text" name="academy_diploma[id]" value="{{ valLangExist($data,'academy_diploma','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Sarjana</label>
					<div class="col-md-5 form-group">
						<input type="text" name="bachelor[en]" value="{{ valLangExist($data,'bachelor','en') }}" class="form-control en">
                        <input type="text" name="bachelor[id]" value="{{ valLangExist($data,'bachelor','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Pasca Sarjana</label>
					<div class="col-md-5 form-group">
						<input type="text" name="post_graduate[en]" value="{{ valLangExist($data,'post_graduate','en') }}" class="form-control en">
                        <input type="text" name="post_graduate[id]" value="{{ valLangExist($data,'post_graduate','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Universitas</label>
					<div class="col-md-5 form-group">
						<input type="text" name="university[en]" value="{{ valLangExist($data,'university','en') }}" class="form-control en">
                        <input type="text" name="university[id]" value="{{ valLangExist($data,'university','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Jurusan</label>
					<div class="col-md-5 form-group">
						<input type="text" name="major[en]" value="{{ valLangExist($data,'major','en') }}" class="form-control en">
                        <input type="text" name="major[id]" value="{{ valLangExist($data,'major','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">IPK</label>
					<div class="col-md-5 form-group">
						<input type="text" name="gpa[en]" value="{{ valLangExist($data,'gpa','en') }}" class="form-control en">
                        <input type="text" name="gpa[id]" value="{{ valLangExist($data,'gpa','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Lingkungan Keluarga</label>
					<div class="col-md-5 form-group">
						<input type="text" name="family_background[en]" value="{{ valLangExist($data,'family_background','en') }}" class="form-control en">
                        <input type="text" name="family_background[id]" value="{{ valLangExist($data,'family_background','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Laki-laki/Perempuan</label>
					<div class="col-md-5 form-group">
						<input type="text" name="male_female[en]" value="{{ valLangExist($data,'male_female','en') }}" class="form-control en">
                        <input type="text" name="male_female[id]" value="{{ valLangExist($data,'male_female','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Profesi</label>
					<div class="col-md-5 form-group">
						<input type="text" name="profession[en]" value="{{ valLangExist($data,'profession','en') }}" class="form-control en">
                        <input type="text" name="profession[id]" value="{{ valLangExist($data,'profession','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Pasangan</label>
					<div class="col-md-5 form-group">
						<input type="text" name="spouse[en]" value="{{ valLangExist($data,'spouse','en') }}" class="form-control en">
                        <input type="text" name="spouse[id]" value="{{ valLangExist($data,'spouse','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Anak</label>
					<div class="col-md-5 form-group">
						<input type="text" name="name_children[en]" value="{{ valLangExist($data,'name_children','en') }}" class="form-control en">
                        <input type="text" name="name_children[id]" value="{{ valLangExist($data,'name_children','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Tempat</label>
					<div class="col-md-5 form-group">
						<input type="text" name="place[en]" value="{{ valLangExist($data,'place','en') }}" class="form-control en">
                        <input type="text" name="place[id]" value="{{ valLangExist($data,'place','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Pendidikan Non Formal</label>
					<div class="col-md-5 form-group">
						<input type="text" name="non_formal_edu[en]" value="{{ valLangExist($data,'non_formal_edu','en') }}" class="form-control en">
                        <input type="text" name="non_formal_edu[id]" value="{{ valLangExist($data,'non_formal_edu','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Training</label>
					<div class="col-md-5 form-group">
						<input type="text" name="training[en]" value="{{ valLangExist($data,'training','en') }}" class="form-control en">
                        <input type="text" name="training[id]" value="{{ valLangExist($data,'training','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Keterangan</label>
					<div class="col-md-5 form-group">
						<input type="text" name="description[en]" value="{{ valLangExist($data,'description','en') }}" class="form-control en">
                        <input type="text" name="description[id]" value="{{ valLangExist($data,'description','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Bahasa Asing</label>
					<div class="col-md-5 form-group">
						<input type="text" name="foreign_lang[en]" value="{{ valLangExist($data,'foreign_lang','en') }}" class="form-control en">
                        <input type="text" name="foreign_lang[id]" value="{{ valLangExist($data,'foreign_lang','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Berbicara</label>
					<div class="col-md-5 form-group">
						<input type="text" name="speak[en]" value="{{ valLangExist($data,'speak','en') }}" class="form-control en">
                        <input type="text" name="speak[id]" value="{{ valLangExist($data,'speak','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Menulis</label>
					<div class="col-md-5 form-group">
						<input type="text" name="write[en]" value="{{ valLangExist($data,'write','en') }}" class="form-control en">
                        <input type="text" name="write[id]" value="{{ valLangExist($data,'write','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Menengah</label>
					<div class="col-md-5 form-group">
						<input type="text" name="intermediate[en]" value="{{ valLangExist($data,'intermediate','en') }}" class="form-control en">
                        <input type="text" name="intermediate[id]" value="{{ valLangExist($data,'intermediate','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Bagus</label>
					<div class="col-md-5 form-group">
						<input type="text" name="good[en]" value="{{ valLangExist($data,'good','en') }}" class="form-control en">
                        <input type="text" name="good[id]" value="{{ valLangExist($data,'good','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Luar Biasa</label>
					<div class="col-md-5 form-group">
						<input type="text" name="excelent[en]" value="{{ valLangExist($data,'excelent','en') }}" class="form-control en">
                        <input type="text" name="excelent[id]" value="{{ valLangExist($data,'excelent','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Organisasi</label>
					<div class="col-md-5 form-group">
						<input type="text" name="organization[en]" value="{{ valLangExist($data,'organization','en') }}" class="form-control en">
                        <input type="text" name="organization[id]" value="{{ valLangExist($data,'organization','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Nama Organisasi</label>
					<div class="col-md-5 form-group">
						<input type="text" name="organization_name[en]" value="{{ valLangExist($data,'organization_name','en') }}" class="form-control en">
                        <input type="text" name="organization_name[id]" value="{{ valLangExist($data,'organization_name','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Jenis Organisasi</label>
					<div class="col-md-5 form-group">
						<input type="text" name="organization_type[en]" value="{{ valLangExist($data,'organization_type','en') }}" class="form-control en">
                        <input type="text" name="organization_type[id]" value="{{ valLangExist($data,'organization_type','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Posisi</label>
					<div class="col-md-5 form-group">
						<input type="text" name="position[en]" value="{{ valLangExist($data,'position','en') }}" class="form-control en">
                        <input type="text" name="position[id]" value="{{ valLangExist($data,'position','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Hobi dan Prestasi</label>
					<div class="col-md-5 form-group">
						<input type="text" name="hobby_achievement[en]" value="{{ valLangExist($data,'hobby_achievement','en') }}" class="form-control en">
                        <input type="text" name="hobby_achievement[id]" value="{{ valLangExist($data,'hobby_achievement','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Hobi</label>
					<div class="col-md-5 form-group">
						<input type="text" name="hobby[en]" value="{{ valLangExist($data,'hobby','en') }}" class="form-control en">
                        <input type="text" name="hobby[id]" value="{{ valLangExist($data,'hobby','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Prestasi</label>
					<div class="col-md-5 form-group">
						<input type="text" name="achievement[en]" value="{{ valLangExist($data,'achievement','en') }}" class="form-control en">
                        <input type="text" name="achievement[id]" value="{{ valLangExist($data,'achievement','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Catatan Kesehatan</label>
					<div class="col-md-5 form-group">
						<input type="text" name="medical_history[en]" value="{{ valLangExist($data,'medical_history','en') }}" class="form-control en">
                        <input type="text" name="medical_history[id]" value="{{ valLangExist($data,'medical_history','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Penyakit yang Diderita</label>
					<div class="col-md-5 form-group">
						<input type="text" name="health_condition[en]" value="{{ valLangExist($data,'health_condition','en') }}" class="form-control en">
                        <input type="text" name="health_condition[id]" value="{{ valLangExist($data,'health_condition','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Tahun</label>
					<div class="col-md-5 form-group">
						<input type="text" name="year[en]" value="{{ valLangExist($data,'year','en') }}" class="form-control en">
                        <input type="text" name="year[id]" value="{{ valLangExist($data,'year','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Dirawat Di</label>
					<div class="col-md-5 form-group">
						<input type="text" name="treated_in[en]" value="{{ valLangExist($data,'treated_in','en') }}" class="form-control en">
                        <input type="text" name="treated_in[id]" value="{{ valLangExist($data,'treated_in','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Pengalaman Kerja</label>
					<div class="col-md-5 form-group">
						<input type="text" name="work_experience[en]" value="{{ valLangExist($data,'work_experience','en') }}" class="form-control en">
                        <input type="text" name="work_experience[id]" value="{{ valLangExist($data,'work_experience','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Nama Perusahaan</label>
					<div class="col-md-5 form-group">
						<input type="text" name="company_name[en]" value="{{ valLangExist($data,'company_name','en') }}" class="form-control en">
                        <input type="text" name="company_name[id]" value="{{ valLangExist($data,'company_name','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Gaji Terakhir</label>
					<div class="col-md-5 form-group">
						<input type="text" name="last_salary[en]" value="{{ valLangExist($data,'last_salary','en') }}" class="form-control en">
                        <input type="text" name="last_salary[id]" value="{{ valLangExist($data,'last_salary','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Alasan Berhenti</label>
					<div class="col-md-5 form-group">
						<input type="text" name="reason_for_leaving[en]" value="{{ valLangExist($data,'reason_for_leaving','en') }}" class="form-control en">
                        <input type="text" name="reason_for_leaving[id]" value="{{ valLangExist($data,'reason_for_leaving','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Harapan Gaji</label>
					<div class="col-md-5 form-group">
						<input type="text" name="expected_salary[en]" value="{{ valLangExist($data,'expected_salary','en') }}" class="form-control en">
                        <input type="text" name="expected_salary[id]" value="{{ valLangExist($data,'expected_salary','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Harapan Karir</label>
					<div class="col-md-5 form-group">
						<input type="text" name="desired_career[en]" value="{{ valLangExist($data,'desired_career','en') }}" class="form-control en">
                        <input type="text" name="desired_career[id]" value="{{ valLangExist($data,'desired_career','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Penempatan</label>
					<div class="col-md-5 form-group">
						<input type="text" name="placement[en]" value="{{ valLangExist($data,'placement','en') }}" class="form-control en">
                        <input type="text" name="placement[id]" value="{{ valLangExist($data,'placement','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Setuju</label>
					<div class="col-md-5 form-group">
						<input type="text" name="agree[en]" value="{{ valLangExist($data,'agree','en') }}" class="form-control en">
                        <input type="text" name="agree[id]" value="{{ valLangExist($data,'agree','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Tidak Setuju</label>
					<div class="col-md-5 form-group">
						<input type="text" name="disagree[en]" value="{{ valLangExist($data,'disagree','en') }}" class="form-control en">
                        <input type="text" name="disagree[id]" value="{{ valLangExist($data,'disagree','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Alasan</label>
					<div class="col-md-5 form-group">
						<input type="text" name="reason[en]" value="{{ valLangExist($data,'reason','en') }}" class="form-control en">
                        <input type="text" name="reason[id]" value="{{ valLangExist($data,'reason','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Shift</label>
					<div class="col-md-5 form-group">
						<input type="text" name="shift[en]" value="{{ valLangExist($data,'shift','en') }}" class="form-control en">
                        <input type="text" name="shift[id]" value="{{ valLangExist($data,'shift','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Referensi</label>
					<div class="col-md-5 form-group">
						<input type="text" name="referred[en]" value="{{ valLangExist($data,'referred','en') }}" class="form-control en">
                        <input type="text" name="referred[id]" value="{{ valLangExist($data,'referred','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Posisi Lain</label>
					<div class="col-md-5 form-group">
						<input type="text" name="another_position[en]" value="{{ valLangExist($data,'another_position','en') }}" class="form-control en">
                        <input type="text" name="another_position[id]" value="{{ valLangExist($data,'another_position','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Tentang Diri Anda</label>
					<div class="col-md-5 form-group">
						<input type="text" name="about_your_self[en]" value="{{ valLangExist($data,'about_your_self','en') }}" class="form-control en">
                        <input type="text" name="about_your_self[id]" value="{{ valLangExist($data,'about_your_self','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Tiga Kebaikan</label>
					<div class="col-md-5 form-group">
						<input type="text" name="goodness[en]" value="{{ valLangExist($data,'goodness','en') }}" class="form-control en">
                        <input type="text" name="goodness[id]" value="{{ valLangExist($data,'goodness','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Tiga Kelemahan</label>
					<div class="col-md-5 form-group">
						<input type="text" name="weaknesses[en]" value="{{ valLangExist($data,'weaknesses','en') }}" class="form-control en">
                        <input type="text" name="weaknesses[id]" value="{{ valLangExist($data,'weaknesses','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Lain-Lain</label>
					<div class="col-md-5 form-group">
						<input type="text" name="etc[en]" value="{{ valLangExist($data,'etc','en') }}" class="form-control en">
                        <input type="text" name="etc[id]" value="{{ valLangExist($data,'etc','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Keluar Negeri</label>
					<div class="col-md-5 form-group">
						<input type="text" name="aboard[en]" value="{{ valLangExist($data,'aboard','en') }}" class="form-control en">
                        <input type="text" name="aboard[id]" value="{{ valLangExist($data,'aboard','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Saya Punya</label>
					<div class="col-md-5 form-group">
						<input type="text" name="i_have[en]" value="{{ valLangExist($data,'i_have','en') }}" class="form-control en">
                        <input type="text" name="i_have[id]" value="{{ valLangExist($data,'i_have','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Saya Tidak Punya</label>
					<div class="col-md-5 form-group">
						<input type="text" name="i_have_not[en]" value="{{ valLangExist($data,'i_have_not','en') }}" class="form-control en">
                        <input type="text" name="i_have_not[id]" value="{{ valLangExist($data,'i_have_not','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Untuk Keperluan</label>
					<div class="col-md-5 form-group">
						<input type="text" name="for_purpose_of[en]" value="{{ valLangExist($data,'for_purpose_of','en') }}" class="form-control en">
                        <input type="text" name="for_purpose_of[id]" value="{{ valLangExist($data,'for_purpose_of','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Kendaraan</label>
					<div class="col-md-5 form-group">
						<input type="text" name="vehicle[en]" value="{{ valLangExist($data,'vehicle','en') }}" class="form-control en">
                        <input type="text" name="vehicle[id]" value="{{ valLangExist($data,'vehicle','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Mobil</label>
					<div class="col-md-5 form-group">
						<input type="text" name="car[en]" value="{{ valLangExist($data,'car','en') }}" class="form-control en">
                        <input type="text" name="car[id]" value="{{ valLangExist($data,'car','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Motor</label>
					<div class="col-md-5 form-group">
						<input type="text" name="motorcycle[en]" value="{{ valLangExist($data,'motorcycle','en') }}" class="form-control en">
                        <input type="text" name="motorcycle[id]" value="{{ valLangExist($data,'motorcycle','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Tidak Punya</label>
					<div class="col-md-5 form-group">
						<input type="text" name="none[en]" value="{{ valLangExist($data,'none','en') }}" class="form-control en">
                        <input type="text" name="none[id]" value="{{ valLangExist($data,'none','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Pemilik Kendaraan</label>
					<div class="col-md-5 form-group">
						<input type="text" name="vehicle_ownership[en]" value="{{ valLangExist($data,'vehicle_ownership','en') }}" class="form-control en">
                        <input type="text" name="vehicle_ownership[id]" value="{{ valLangExist($data,'vehicle_ownership','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Milik Pribadi</label>
					<div class="col-md-5 form-group">
						<input type="text" name="privately[en]" value="{{ valLangExist($data,'privately','en') }}" class="form-control en">
                        <input type="text" name="privately[id]" value="{{ valLangExist($data,'privately','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Milik Orang Tua</label>
					<div class="col-md-5 form-group">
						<input type="text" name="parent_vehicle[en]" value="{{ valLangExist($data,'parent_vehicle','en') }}" class="form-control en">
                        <input type="text" name="parent_vehicle[id]" value="{{ valLangExist($data,'parent_vehicle','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Tinggi</label>
					<div class="col-md-5 form-group">
						<input type="text" name="height[en]" value="{{ valLangExist($data,'height','en') }}" class="form-control en">
                        <input type="text" name="height[id]" value="{{ valLangExist($data,'height','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Berat</label>
					<div class="col-md-5 form-group">
						<input type="text" name="weight[en]" value="{{ valLangExist($data,'weight','en') }}" class="form-control en">
                        <input type="text" name="weight[id]" value="{{ valLangExist($data,'weight','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Kartu BPJS</label>
					<div class="col-md-5 form-group">
						<input type="text" name="bpjs_card[en]" value="{{ valLangExist($data,'bpjs_card','en') }}" class="form-control en">
                        <input type="text" name="bpjs_card[id]" value="{{ valLangExist($data,'bpjs_card','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Punya</label>
					<div class="col-md-5 form-group">
						<input type="text" name="have[en]" value="{{ valLangExist($data,'have','en') }}" class="form-control en">
                        <input type="text" name="have[id]" value="{{ valLangExist($data,'have','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Belum</label>
					<div class="col-md-5 form-group">
						<input type="text" name="not_yet[en]" value="{{ valLangExist($data,'not_yet','en') }}" class="form-control en">
                        <input type="text" name="not_yet[id]" value="{{ valLangExist($data,'not_yet','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Persetujuan </label>
					<div class="col-md-5 form-group">
						<textarea name="approval[en]" rows="3" class="form-control en">{{ valLangExist($data,'approval','en') }}</textarea>
						<textarea name="approval[id]" rows="3" class="form-control id">{{ valLangExist($data,'approval','id') }}</textarea>
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Cek Kembali</label>
					<div class="col-md-5 form-group">
						<input type="text" name="recheck[en]" value="{{ valLangExist($data,'recheck','en') }}" class="form-control en">
                        <input type="text" name="recheck[id]" value="{{ valLangExist($data,'recheck','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Tombol Lanjut Tes Kepribadian</label>
					<div class="col-md-5 form-group">
						<input type="text" name="btn_personality_test[en]" value="{{ valLangExist($data,'btn_personality_test','en') }}" class="form-control en">
                        <input type="text" name="btn_personality_test[id]" value="{{ valLangExist($data,'btn_personality_test','id') }}" class="form-control id">
					</div>
				</div>
				<label for="" class="text-bold">Tes Kepribadian</label>
				<div class="row">
					<label class="col-md-2 control-label">Judul Form Kepribadian </label>
					<div class="col-md-5 form-group">
						<input type="text" name="title_disc_form[en]" value="{{ valLangExist($data,'title_disc_form','en') }}" class="form-control en">
                        <input type="text" name="title_disc_form[id]" value="{{ valLangExist($data,'title_disc_form','id') }}" class="form-control id">
					</div>
				</div>
                <div class="row">
					<label class="col-md-2 control-label">Keterangan DISC </label>
					<div class="col-md-5 form-group">
						<textarea name="desc_disc[en]" rows="3" class="form-control en">{{ valLangExist($data,'desc_disc','en') }}</textarea>
						<textarea name="desc_disc[id]" rows="3" class="form-control id">{{ valLangExist($data,'desc_disc','id') }}</textarea>
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Mulai </label>
					<div class="col-md-5 form-group">
						<input type="text" name="start[en]" value="{{ valLangExist($data,'start','en') }}" class="form-control en">
                        <input type="text" name="start[id]" value="{{ valLangExist($data,'start','id') }}" class="form-control id">
					</div>
				</div>
				<hr>
				<label for="">Form Tes Kepribadian</label>
				<div class="row">
					<label class="col-md-2 control-label">Tes Kepribadian </label>
					<div class="col-md-5 form-group">
						<input type="text" name="personality_test[en]" value="{{ valLangExist($data,'personality_test','en') }}" class="form-control en">
                        <input type="text" name="personality_test[id]" value="{{ valLangExist($data,'personality_test','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Nomor </label>
					<div class="col-md-5 form-group">
						<input type="text" name="no[en]" value="{{ valLangExist($data,'no','en') }}" class="form-control en">
                        <input type="text" name="no[id]" value="{{ valLangExist($data,'no','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Mirip </label>
					<div class="col-md-5 form-group">
						<input type="text" name="most[en]" value="{{ valLangExist($data,'most','en') }}" class="form-control en">
                        <input type="text" name="most[id]" value="{{ valLangExist($data,'most','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Tidak Mirip </label>
					<div class="col-md-5 form-group">
						<input type="text" name="least[en]" value="{{ valLangExist($data,'least','en') }}" class="form-control en">
                        <input type="text" name="least[id]" value="{{ valLangExist($data,'least','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Waktu </label>
					<div class="col-md-5 form-group">
						<input type="text" name="timer[en]" value="{{ valLangExist($data,'timer','en') }}" class="form-control en">
                        <input type="text" name="timer[id]" value="{{ valLangExist($data,'timer','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Waktu Berakhir </label>
					<div class="col-md-5 form-group">
						<input type="text" name="end_time[en]" value="{{ valLangExist($data,'end_time','en') }}" class="form-control en">
                        <input type="text" name="end_time[id]" value="{{ valLangExist($data,'end_time','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Tombol Lanjut Tes IQ</label>
					<div class="col-md-5 form-group">
						<input type="text" name="btn_iq_test[en]" value="{{ valLangExist($data,'btn_iq_test','en') }}" class="form-control en">
                        <input type="text" name="btn_iq_test[id]" value="{{ valLangExist($data,'btn_iq_test','id') }}" class="form-control id">
					</div>
				</div>
				<hr>
				<label for="" class="text-bold">Tes IQ</label>
				<div class="row">
					<label class="col-md-2 control-label">Judul Form IQ </label>
					<div class="col-md-5 form-group">
						<input type="text" name="title_iq_form[en]" value="{{ valLangExist($data,'title_iq_form','en') }}" class="form-control en">
                        <input type="text" name="title_iq_form[id]" value="{{ valLangExist($data,'title_iq_form','id') }}" class="form-control id">
					</div>
				</div>
                <div class="row">
					<label class="col-md-2 control-label">Keterangan IQ </label>
					<div class="col-md-5 form-group">
						<textarea name="desc_iq[en]" rows="3" class="form-control en">{{ valLangExist($data,'desc_iq','en') }}</textarea>
						<textarea name="desc_iq[id]" rows="3" class="form-control id">{{ valLangExist($data,'desc_iq','id') }}</textarea>
					</div>
				</div>
				<hr>
				<label for="">Form Tes IQ</label>
				<div class="row">
					<label class="col-md-2 control-label">Tes IQ </label>
					<div class="col-md-5 form-group">
						<input type="text" name="iq_test[en]" value="{{ valLangExist($data,'iq_test','en') }}" class="form-control en">
                        <input type="text" name="iq_test[id]" value="{{ valLangExist($data,'iq_test','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Simpan Dan Selesai </label>
					<div class="col-md-5 form-group">
						<input type="text" name="save_done[en]" value="{{ valLangExist($data,'save_done','en') }}" class="form-control en">
                        <input type="text" name="save_done[id]" value="{{ valLangExist($data,'save_done','id') }}" class="form-control id">
					</div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Terimakasih </label>
					<div class="col-md-5 form-group">
						<input type="text" name="thanks[en]" value="{{ valLangExist($data,'thanks','en') }}" class="form-control en">
                        <input type="text" name="thanks[id]" value="{{ valLangExist($data,'thanks','id') }}" class="form-control id">
					</div>
				</div>
				<div class="pull-right">
					<button type="submit" class="btn btn-primary"><i class="icon-floppy-disk position-left"></i> Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>

@if(!request()->ajax())
@push('scripts')
@endif
<script>
    $('form').find('input,textarea').hide()
    $('.'+$('[name="set_lang"]').val()).show()
    $('[name="set_lang"]').change(function(){
        $('form').find('input,textarea').hide()
        $('.'+$('[name="set_lang"]').val()).show()
    })
</script>
@if(!request()->ajax())
@endpush
@endif
