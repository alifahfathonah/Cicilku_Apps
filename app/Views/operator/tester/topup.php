<h2>Top Up</h2>
<form action="<?= base_url('/rekening/setor'); ?>">
   <?= csrf_field(); ?>
   <p>Semester ID</p>
   <select name="semester_id" id="">
      <?php foreach ($semester as $s) : ?>
         <option value="<?= $s['id']; ?>"><?= $s['semester']; ?>(<?= date('d M Y', $s['periode_awal']); ?> - <?= date('d M Y', $s['periode_akhir']); ?>)</option>
      <?php endforeach; ?>
   </select>
   <br>
   <p>Rekening ID (<?= $rekening['no_rekening']; ?>)</p>
   <input type="text" name="rekening_id" id="rekening_id" value="<?= $rekening['id']; ?>"> <br>
   <p>Siswa ID (<?= $siswa['username']; ?>)</p>
   <input type="text" name="siswa_id" id="siswa_id" value="<?= $siswa['id']; ?>"> <br>
   <p>Guru ID</p>
   <input type="text" name="guru_id" id="guru_id" value="<?= $kelas[0]->guru_id; ?>"> <br>
   <p>Nominal</p>
   <input type="text" name="nominal" id="nominal"> <br>
   <p>Keterangan</p>
   <input type="text" name="status" id="status" value="pending">
   <textarea name="keterangan" id="keterangan" cols="30" rows="10"></textarea>
   <button type="submit">Setor</button>
</form>