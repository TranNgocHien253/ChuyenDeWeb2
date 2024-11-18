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

var scrollToTopBtn = document.getElementById("scrollToTopBtn");

  window.onscroll = function() {
    if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
      scrollToTopBtn.classList.remove("opacity-0", "invisible");
      scrollToTopBtn.classList.add("opacity-100", "visible");
    } else {
      scrollToTopBtn.classList.remove("opacity-100", "visible");
      scrollToTopBtn.classList.add("opacity-0", "invisible");
    }
  };

  function scrollToTop() {
    window.scrollTo({
      top: 0,
      behavior: "smooth"
    });
  }

function openMapModal() {
    document.getElementById('mapModal').classList.remove('hidden');
    initMap();  // Gọi hàm initMap khi modal hiển thị
}

function closeMapModal() {
    document.getElementById('mapModal').classList.add('hidden');
}

function loadMap() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            const userLocation = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };

            const map = new google.maps.Map(document.getElementById('map'), {
                center: userLocation,
                zoom: 14
            });

            new google.maps.Marker({
                position: userLocation,
                map: map,
                title: "Vị trí của bạn",
                icon: "http://maps.google.com/mapfiles/ms/icons/blue-dot.png"
            });

            const stores = [
                { name: "Cửa hàng 1", lat: 21.028511, lng: 105.804817 },
                { name: "Cửa hàng 2", lat: 21.028000, lng: 105.805000 },
                { name: "Cửa hàng 3", lat: 21.029000, lng: 105.806000 }
            ];

            stores.forEach(function(store) {
                new google.maps.Marker({
                    position: { lat: store.lat, lng: store.lng },
                    map: map,
                    title: store.name
                });
            });
        }, function(error) {
            alert("Không thể lấy vị trí người dùng.");
        });
    } else {
        alert("Trình duyệt không hỗ trợ Geolocation.");
    }
}
