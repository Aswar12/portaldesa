<!-- ======= Footer ======= -->
<footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-4 col-md-6 footer-info">
            <div class="d-flex align-items-center mb-3">
              <img src="{{ asset('storage/' . $logo->logo) }}" alt="Logo" height="60" class="me-3">
              <h3 class="m-0">{{ $nm_desa }}</h3>
            </div>
            <p class="mb-2">
              <i class="bi bi-geo-alt me-2"></i> Kec. {{ $kecamatan }}, Kab. {{ $kabupaten }}, {{ $provinsi }} {{ $kode_pos }}
            </p>
            <p class="mb-1"><i class="bi bi-phone me-2"></i> {{ $no_hp }}</p>
            <p class="mb-3"><i class="bi bi-envelope me-2"></i> {{ $email }}</p>
            
            <div class="d-flex mt-3">
              <a href="#" class="me-2"><i class="bi bi-facebook fs-5"></i></a>
              <a href="#" class="me-2"><i class="bi bi-instagram fs-5"></i></a>
              <a href="#" class="me-2"><i class="bi bi-twitter fs-5"></i></a>
              <a href="#" class="me-2"><i class="bi bi-youtube fs-5"></i></a>
            </div>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Menu Utama</h4>
            <ul class="list-unstyled">
              <li class="mb-2"><a href="/"><i class="bi bi-chevron-right me-1"></i> Beranda</a></li>
              <li class="mb-2"><a href="/berita"><i class="bi bi-chevron-right me-1"></i> Berita</a></li>
              <li class="mb-2"><a href="/umkm"><i class="bi bi-chevron-right me-1"></i> UMKM</a></li>
              <li class="mb-2"><a href="/kontak"><i class="bi bi-chevron-right me-1"></i> Kontak</a></li>
              <li class="mb-2"><a href="/peta-desa"><i class="bi bi-chevron-right me-1"></i> Peta Desa</a></li>
            </ul>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Profil Desa</h4>
            <ul class="list-unstyled">
              <li class="mb-2"><a href="/wilayah"><i class="bi bi-chevron-right me-1"></i> Wilayah</a></li>
              <li class="mb-2"><a href="/sejarah"><i class="bi bi-chevron-right me-1"></i> Sejarah</a></li>
              <li class="mb-2"><a href="/visi-misi"><i class="bi bi-chevron-right me-1"></i> Visi & Misi</a></li>
              <li class="mb-2"><a href="/perangkat-desa"><i class="bi bi-chevron-right me-1"></i> Perangkat</a></li>
            </ul>
          </div>

          <div class="col-lg-4 col-md-6">
            <h4>Lokasi Desa</h4>
            <div class="footer-map">
              <iframe width="100%" height="200" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" id="gmap_canvas" 
                src="https://maps.google.com/maps?width=520&amp;height=200&amp;hl=en&amp;q={{ urlencode($kecamatan . ', ' . $kabupaten . ', ' . $provinsi) }}&amp;t=h&amp;z=13&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright py-3 text-center">
        &copy; {{ date('Y') }} <strong>Portal Desa {{ $nm_desa ?? 'Antarkanmaa' }}</strong>. All Rights Reserved.
      </div>
    </div>
  </footer><!-- End Footer -->