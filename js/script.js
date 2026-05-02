/*
    File: js/script.js
    Date: 01 May 2026 23:34 AEST
    Version: v01
*/
// --- Theme toggle with persistence ---
const tg = document.getElementById('themeToggle');
function applyTheme(t){
  document.body.classList.remove('light','dark');
  document.body.classList.add(t);
  tg.textContent = (t==='light') ? '🌙 Dark Theme' : '☀️ Light Theme';
  tg.setAttribute('aria-pressed', String(t==='dark'));
  localStorage.setItem('theme', t);
}
tg.addEventListener('click', ()=> applyTheme(document.body.classList.contains('dark')?'light':'dark'));
document.addEventListener('DOMContentLoaded', ()=>{
  applyTheme(localStorage.getItem('theme') || 'dark');
  document.getElementById('y').textContent = new Date().getFullYear();
});

// --- Modal System ---
const enquiryBtn = document.getElementById('enquiryBtn');
const cancelBtn = document.getElementById('cancelBtn');
const enquiryModal = document.getElementById('enquiryModal');
const actionModal = document.getElementById('actionModal');
const imgModal = document.getElementById('imgModal');
const modalImg = document.getElementById('modalImg');

function openModal(modal) { if(modal) modal.classList.add('open'); }
function closeModal(modal) { if(modal) modal.classList.remove('open'); }

enquiryBtn.addEventListener('click', (e) => { e.preventDefault(); openModal(enquiryModal); });
cancelBtn.addEventListener('click', () => closeModal(enquiryModal));

document.querySelectorAll('.js-modal').forEach(link => {
  link.addEventListener('click', (e) => {
    const src = link.getAttribute('data-full');
    if(src){ modalImg.src = src; openModal(imgModal); }
  });
});

document.addEventListener('click', (e) => {
  if(e.target.classList.contains('modal')){ closeModal(e.target); }
});
document.addEventListener('keydown', e => { if(e.key==='Escape') { [enquiryModal, actionModal, imgModal].forEach(closeModal); } });

// --- Form Handling ---
const enquiryForm = document.getElementById('enquiryForm');
enquiryForm.addEventListener('submit', handleFormSubmit);

function handleFormSubmit(event) {
    event.preventDefault();
    const formData = new FormData(event.target);
    const name = formData.get('name');
    const enquiryText = `
Enquiry Details
--------------------------------
Reason: ${formData.get('enquiry-reason')}
Name: ${name}
Email: ${formData.get('email')}
Phone: ${formData.get('phone') || 'Not provided'}
Message: ${formData.get('message') || 'Not provided'}
--------------------------------
Sent to Colin Dixon via ozol.au`.trim();

    document.getElementById('formatted-enquiry').textContent = enquiryText;
    const subject = `Website Enquiry: ${formData.get('enquiry-reason')} from ${name}`;
    const mailtoLink = `mailto:col@ozol.au?subject=${encodeURIComponent(subject)}&body=${encodeURIComponent(enquiryText)}`;
    document.getElementById('emailUsBtn').href = mailtoLink;
    
    closeModal(enquiryModal);
    openModal(actionModal);
}

document.getElementById('emailUsBtn').addEventListener('click', (e) => {
    e.preventDefault();
    window.open(e.currentTarget.href, 'mail', 'width=800,height=600,scrollbars=yes,resizable=yes');
});

const copyBtn = document.getElementById('copyBtn');
copyBtn.addEventListener('click', () => {
    navigator.clipboard.writeText(document.getElementById('formatted-enquiry').textContent).then(() => {
        const originalText = copyBtn.textContent;
        copyBtn.textContent = 'Copied!';
        setTimeout(() => { copyBtn.textContent = originalText; }, 2000);
    });
});

// --- URL Shortener Handling ---
const shortenForm = document.getElementById('shortenForm');
const shortenBtn = document.getElementById('shortenBtn');
const shortenResult = document.getElementById('shortenResult');
const shortUrlDisplay = document.getElementById('shortUrlDisplay');
const copyShortUrlBtn = document.getElementById('copyShortUrlBtn');
const qrCodeContainer = document.getElementById('qrCodeContainer');
const qrCodeImg = document.getElementById('qrCodeImg');
const downloadQrBtn = document.getElementById('downloadQrBtn');
const shortenError = document.getElementById('shortenError');

if (shortenForm) {
    shortenForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        
        const longUrl = document.getElementById('longUrl').value;
        const customKeyword = document.getElementById('customKeyword').value;
        
        // Reset UI
        shortenResult.style.display = 'none';
        shortenError.style.display = 'none';
        if (qrCodeContainer) qrCodeContainer.style.display = 'none';
        shortenBtn.disabled = true;
        shortenBtn.textContent = 'Shortening...';
        
        try {
            const formData = new FormData();
            formData.append('url', longUrl);
            if (customKeyword) formData.append('keyword', customKeyword);
            
            const response = await fetch('/shorten.php', {
                method: 'POST',
                body: formData
            });
            
            const data = await response.json();
            
            if (data && data.status === 'success') {
                shortUrlDisplay.value = data.shorturl;
                if (qrCodeImg && downloadQrBtn && qrCodeContainer) {
                    const qrUrl = data.shorturl + '.qr';
                    qrCodeImg.src = qrUrl;
                    qrCodeImg.alt = 'QR Code for ' + data.shorturl;
                    downloadQrBtn.href = qrUrl;
                    
                    const keyword = data?.url?.keyword || new URL(data.shorturl).pathname.replace(/^\/+/, '').replace(/\/$/, '');
                    downloadQrBtn.download = 'QR-' + keyword + '.png';
                    
                    qrCodeContainer.style.display = 'block';
                }
                shortenResult.style.display = 'block';
                shortenForm.reset();
            } else {
                shortenError.textContent = data.message || 'An error occurred while shortening the URL.';
                shortenError.style.display = 'block';
            }
        } catch (error) {
            shortenError.textContent = 'Network error. Please try again.';
            shortenError.style.display = 'block';
        } finally {
            shortenBtn.disabled = false;
            shortenBtn.textContent = 'Shorten';
        }
    });
    
    copyShortUrlBtn.addEventListener('click', () => {
        shortUrlDisplay.select();
        navigator.clipboard.writeText(shortUrlDisplay.value).then(() => {
            const originalText = copyShortUrlBtn.textContent;
            copyShortUrlBtn.textContent = 'Copied!';
            setTimeout(() => { copyShortUrlBtn.textContent = originalText; }, 2000);
        });
    });
}
