let currentIndex = 0;
const slides = document.querySelectorAll('#slideContainer > div'); // Lấy tất cả các slide
const totalSlides = slides.length;
const slideInterval = 2000; // Thời gian chuyển đổi giữa các slide (2 giây)

const nextSlide = () => {
    if (currentIndex < totalSlides - 1) {
        currentIndex++;
    } else {
        currentIndex = 0; // Quay lại slide đầu tiên
    }
    updateSlidePosition();
};

const prevSlide = () => {
    if (currentIndex > 0) {
        currentIndex--;
    } else {
        currentIndex = totalSlides - 1; // Quay lại slide cuối cùng
    }
    updateSlidePosition();
};

document.getElementById('nextSlide').addEventListener('click', nextSlide);
document.getElementById('prevSlide').addEventListener('click', prevSlide);

// Cập nhật vị trí của slide
function updateSlidePosition() {
    const slideWidth = slides[0].clientWidth; // Lấy chiều rộng của một slide
    const offset = -slideWidth * currentIndex; // Tính toán vị trí cần di chuyển
    document.getElementById('slideContainer').style.transform = `translateX(${offset}px)`;
    updateDots(); // Cập nhật dấu chấm
}

// Cập nhật dấu chấm
function updateDots() {
    const dots = document.querySelectorAll('.dot');
    dots.forEach((dot, index) => {
        dot.classList.remove('opacity-100');
        dot.classList.add('opacity-50');
        if (index === currentIndex) {
            dot.classList.remove('opacity-50');
            dot.classList.add('opacity-100');
        }
    });
}

// Thiết lập interval tự động chuyển đổi giữa các slide
setInterval(nextSlide, slideInterval);
