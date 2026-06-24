<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\{User, Service, Skill, Education, Experience, Certification, Setting, Testimonial};

class InitialDataSeeder extends Seeder {
    public function run(): void {
        // Create Admin User
        User::updateOrCreate(
            ['email' => 'admin@portfolio.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('password123'),
                'email_verified_at' => now(),
            ]
        );

        // Settings
        $settings = [
            ['key'=>'site_name','value'=>'Portfolio.OS','group'=>'general'],
            ['key'=>'hero_title','value'=>'I am a Full Stack Developer','group'=>'general'],
            ['key'=>'hero_subtitle','value'=>'Architecting seamless digital experiences with precision engineering and avant-garde aesthetics.','group'=>'general'],
            ['key'=>'footer_text','value'=>'Professional solutions for your digital and physical infrastructure needs.','group'=>'general'],
            ['key'=>'contact_email','value'=>'admin@portfolio.com','group'=>'general'],
            ['key'=>'contact_phone','value'=>'+62 812 3456 7890','group'=>'general'],
            ['key'=>'whatsapp_number','value'=>'+6281234567890','group'=>'general'],
            ['key'=>'contact_address','value'=>'Jakarta, Indonesia','group'=>'general'],
        ];
        foreach($settings as $s) {
            Setting::updateOrCreate(['key' => $s['key']], $s);
        }

        // Services
        $services = [
            ['title'=>'Jasa Pasang CCTV','slug'=>'jasa-pasang-cctv','description'=>'Instalasi CCTV profesional untuk rumah, kantor, dan industri. Monitoring remote 24/7 dengan kualitas 4K Ultra HD.','icon'=>'bi-camera-video','price_min'=>1500000,'price_max'=>15000000,'price_label'=>'Start from Rp 1.5jt','status'=>'active','features'=>['4K Ultra HD Quality','Cloud Storage & Remote Access','Night Vision Technology','Mobile App Integration','Professional Installation','1 Year Warranty'],'sort_order'=>1],
            ['title'=>'Web Development','slug'=>'web-development','description'=>'Pembuatan website profesional dengan teknologi modern. Responsive, SEO-friendly, dan performa tinggi.','icon'=>'bi-code-slash','price_min'=>2000000,'price_max'=>50000000,'price_label'=>'Start from Rp 2jt','status'=>'active','features'=>['Responsive Design','SEO Optimized','Fast Loading Speed','Admin Panel','SSL Certificate','Free Maintenance 3 Bulan'],'sort_order'=>2],
            ['title'=>'Service Laptop','slug'=>'service-laptop','description'=>'Servis laptop profesional dari software hingga hardware. Motherboard repair, upgrade SSD/RAM, cleaning thermal.','icon'=>'bi-laptop','price_min'=>100000,'price_max'=>5000000,'price_label'=>'Start from Rp 100rb','status'=>'active','features'=>['Free Diagnosis','Motherboard Repair','SSD/RAM Upgrade','Thermal Paste Replacement','OS Installation','Data Recovery'],'sort_order'=>3],
        ];
        foreach($services as $s) {
            Service::updateOrCreate(['slug' => $s['slug']], $s);
        }

        // Skills
        $skills = [
            ['name'=>'Laravel/PHP','category'=>'technical','level'=>95,'color'=>'#FF2D20','icon'=>'bi-filetype-php'],
            ['name'=>'React/Next.js','category'=>'technical','level'=>90,'color'=>'#61DAFB','icon'=>'bi-filetype-jsx'],
            ['name'=>'MySQL/PostgreSQL','category'=>'technical','level'=>88,'color'=>'#4479A1','icon'=>'bi-database'],
            ['name'=>'Tailwind CSS','category'=>'technical','level'=>92,'color'=>'#06B6D4','icon'=>'bi-palette'],
            ['name'=>'CCTV Installation','category'=>'technical','level'=>95,'color'=>'#2C74B3','icon'=>'bi-camera-video'],
            ['name'=>'Hardware Repair','category'=>'technical','level'=>90,'color'=>'#205295','icon'=>'bi-cpu'],
            ['name'=>'Problem Solving','category'=>'soft','level'=>95,'color'=>'#75b798','icon'=>'bi-lightbulb'],
            ['name'=>'Communication','category'=>'soft','level'=>88,'color'=>'#6f42c1','icon'=>'bi-chat-dots'],
        ];
        foreach($skills as $i => $s) {
            Skill::updateOrCreate(['name' => $s['name']], array_merge($s, ['sort_order'=>$i+1]));
        }

        // Education
        $educations = [
            ['degree'=>'S1 Teknik Informatika','institution'=>'Universitas Teknologi','year_start'=>'2018','year_end'=>'2022','description'=>'Fokus pada Software Engineering dan Sistem Terdistribusi','sort_order'=>1],
            ['degree'=>'SMK Jurusan RPL','institution'=>'SMK Negeri 1','year_start'=>'2015','year_end'=>'2018','description'=>'Rekayasa Perangkat Lunak','sort_order'=>2],
        ];
        foreach($educations as $e) {
            Education::updateOrCreate(['degree' => $e['degree'], 'institution' => $e['institution']], $e);
        }

        // Experience
        $experiences = [
            ['position'=>'Full Stack Developer','company'=>'Freelance','year_start'=>'2022','year_end'=>null,'description'=>'Mengerjakan berbagai project web development, instalasi CCTV, dan service laptop untuk klien individu dan perusahaan.','is_current'=>true,'sort_order'=>1],
            ['position'=>'Junior Web Developer','company'=>'Tech Company','year_start'=>'2020','year_end'=>'2022','description'=>'Membangun aplikasi web menggunakan Laravel dan React.','is_current'=>false,'sort_order'=>2],
        ];
        foreach($experiences as $e) {
            Experience::updateOrCreate(['position' => $e['position'], 'company' => $e['company']], $e);
        }

        // Certifications
        $certs = [
            ['name'=>'Laravel Certified','issuer'=>'Laravel','year'=>'2023','icon'=>'bi-patch-check-fill','sort_order'=>1],
            ['name'=>'AWS Cloud Practitioner','issuer'=>'Amazon Web Services','year'=>'2023','icon'=>'bi-cloud-check','sort_order'=>2],
            ['name'=>'CCTV Technician','issuer'=>'Professional Certification','year'=>'2022','icon'=>'bi-camera-video-fill','sort_order'=>3],
        ];
        foreach($certs as $c) {
            Certification::updateOrCreate(['name' => $c['name'], 'issuer' => $c['issuer']], $c);
        }

        // Testimonials
        $testimonials = [
            ['client_name'=>'Budi Santoso','client_position'=>'Business Owner','message'=>'Pelayanan sangat profesional! CCTV rumah saya terpasang dengan rapi dan kualitas gambar sangat jernih. Highly recommended!','rating'=>5,'is_published'=>true,'sort_order'=>1],
            ['client_name'=>'Siti Rahayu','client_position'=>'Startup Founder','message'=>'Website yang dibuat sangat modern dan cepat. Admin panelnya mudah digunakan. Terima kasih!','rating'=>5,'is_published'=>true,'sort_order'=>2],
            ['client_name'=>'Ahmad Fauzi','client_position'=>'Karyawan Swasta','message'=>'Laptop saya yang mati total bisa hidup lagi setelah diservice di sini. Proses cepat dan harga terjangkau.','rating'=>5,'is_published'=>true,'sort_order'=>3],
        ];
        foreach($testimonials as $t) {
            Testimonial::updateOrCreate(['client_name' => $t['client_name'], 'client_position' => $t['client_position']], $t);
        }
    }
}