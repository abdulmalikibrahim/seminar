import React from 'react';
import '../assets/style.css'

const Rundown = () => {
    return(
        <div className="bee-page-container mt-5">
            <Index/>
        </div>
    )
}

const Index = () => {
    let nomor = 1;
    return(
        <div className='bg-page-image ps-3 pe-3'>
            <div className="bee-row bee-row-4" style={{backgroundColor:"rgba(0,0,0,0)"}}>
                <div className="bee-row-content" style={{backgroundColor:"rgba(0,0,0,0)"}}>
                    <div className="bee-col bee-col-1 bee-col-w12">
                        <div className="bee-block bee-block-1 bee-spacer">
                            <div className="spacer" style={{ height: 55 }} />
                        </div>
                        <div className="bee-block bee-block-3 bee-heading">
                            <h2 style={{
                                color: "#2b2b2b",
                                direction: "ltr",
                                fontFamily:
                                    "Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif",
                                fontSize: 30,
                                fontWeight: 700,
                                letterSpacing: "normal",
                                lineHeight: "120%",
                                textAlign: "center",
                                marginTop: 0,
                                marginBottom: 0
                                }}>
                                <span className="tinyMce-placeholder"> Rundown Acara : </span>
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
            <div className='row d-flex justify-content-center'>
                <div className='col-lg-9'>
                    <table className='table table-sm table-borderless table-hover'>
                        <thead className='thead-light'>
                            <tr className='text-center' style={{ fontSize: "9pt" }}>
                            <th className='pt-3 pb-3 align-middle bg-orange text-light'>No</th>
                            <th className='pt-3 pb-3 align-middle bg-orange text-light'>Jam</th>
                            <th className='pt-3 pb-3 align-middle bg-orange text-light' style={{ minWidth: "100px" }}>Durasi</th>
                            <th className='pt-3 pb-3 align-middle bg-orange text-light'>Kegiatan</th>
                            <th className='pt-3 pb-3 align-middle bg-orange text-light'>Penanggung Jawab</th>
                            <th className='pt-3 pb-3 align-middle bg-orange text-light'>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            {[
                            ["08:30 - 09:00", "30 Menit", "Persiapan Acara", "Operator", "Menyiapkan link Zoom Meeting, tes audio, share screen, dan memastikan teknis siap"],
                            ["09:00 - 09:10", "10 Menit", "Peserta Memasuki Zoom Meet", "Operator", "Memutar musik pembuka dan menyapa peserta yang masuk"],
                            ["09:10 - 09:15", "5 Menit", "Pembukaan Acara", "MC", "Memberi salam pembuka dan menjelaskan alur acara"],
                            ["09:15 - 09:20", "5 Menit", "Pembacaan Doa Pembuka", "MC", "Doa Lintas Agama"],
                            ["09:20 - 09:25", "5 Menit", "Menyanyikan Lagu Indonesia Raya & Mars UPB", "Operator", "Share screen video lagu, memastikan audio dan partisipasi peserta"],
                            ["09:25 - 09:30", "5 Menit", "Sambutan Ketua Pelaksana", "Fahri Al Zakwan", "Memberikan sambutan singkat atas nama panitia"],
                            ["09:30 - 09:40", "10 Menit", "Sambutan Dosen Fisika", "Bpk. Muhammad Makmun Effendi, S.Kom., M.Kom.", "Memberikan sambutan resmi dan dukungan akademik"],
                            ["09:40 - 09:45", "5 Menit", "Penutupan Opening Ceremony", "MC", "Menyimpulkan sesi pembuka, alihkan ke sesi materi"],
                            ["09:45 - 09:50", "5 Menit", "Pembukaan Sesi Materi", "MC", "Perkenalan singkat, pengantar menuju sesi inti"],
                            ["09:50 - 09:55", "5 Menit", "Pembacaan CV Moderator", "MC", "Membacakan profil moderator lalu menyerahkan ke moderator"],
                            ["09:55 - 10:00", "5 Menit", "Pembukaan Moderator & Pembacaan CV Pemateri", "Moderator", "Menyambut peserta dan mengenalkan pemateri"],
                            ["10:00 - 10:50", "50 Menit", "Pemaparan Materi", "Bpk. Suripno, S.T., M.Pd.", "Menyampaikan materi utama seminar secara interaktif"],
                            ["10:50 - 11:00", "10 Menit", "Sesi Tanya Jawab (Q&A)", "Moderator, Pemateri, dan Peserta", "Moderator memandu sesi tanya jawab interaktif dari peserta"],
                            ["11:00 - 11:05", "5 Menit", "Pembacaan Doa Penutup", "Silvie Fadhlia Aghata", "Menutup acara secara spiritual dengan doa singkat"],
                            ["11:05 - 11:10", "5 Menit", "Penutupan Akhir, Presensi, dan Dokumentasi Peserta", "Seluruh Panitia dan Peserta", "MC umumkan link presensi, panitia ambil dokumentasi akhir via Zoom"]
                            ].map(([jam, durasi, kegiatan, penanggungJawab, keterangan], index) => (
                            <tr key={index} style={{ fontSize: "9pt" }} className='align-middle table-light text-center'>
                                <td className='bg-orange-soft'>{index + 1}</td>
                                <td className='bg-orange-soft'>{jam}</td>
                                <td className='bg-orange-soft'>{durasi}</td>
                                <td className='bg-orange-soft text-start'>{kegiatan}</td>
                                <td className='bg-orange-soft'>{penanggungJawab}</td>
                                <td className='bg-orange-soft align-middle text-start'>{keterangan}</td>
                            </tr>
                            ))}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    )
}

export default Rundown;