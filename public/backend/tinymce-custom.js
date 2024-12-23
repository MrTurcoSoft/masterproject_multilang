// TinyMCE API Anahtarları
const apiKeys = ["rxsyy1qolq5f3ckly234yc95bd41cwa6pkx28ybgkk94oj1u", "50qd330x8cbhkfpkkxonsr53njlymt1nsvxsnetf4u0u4mrb"];
let currentKeyIndex = 0;

// TinyMCE'yi başlatan fonksiyon
function initTinyMCE() {
    tinymce.init({
        selector: '.tinymce-editor',
        apiKey: apiKeys[currentKeyIndex],
        plugins: 'autolink lists link image charmap print preview hr anchor',
        toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat',
        setup: function (editor) {
            editor.on('error', function (error) {
                console.error("TinyMCE Hatası:", error.message);
                if (error.message.includes('API key limit')) {
                    console.warn('API anahtarı limiti aşıldı. Yeni anahtar kullanılacak.');
                    switchApiKey();
                }
            });
        },
    });
}

// API Anahtarını değiştiren fonksiyon
function switchApiKey() {
    currentKeyIndex = (currentKeyIndex + 1) % apiKeys.length;
    console.log("Yeni API Anahtarı Kullanılıyor:", apiKeys[currentKeyIndex]);
    tinymce.remove(); // Mevcut TinyMCE'yi kaldır
    initTinyMCE(); // Yeni anahtarla başlat
}

// Sayfa yüklendiğinde TinyMCE'yi başlat
document.addEventListener('DOMContentLoaded', function () {
    initTinyMCE();
});
