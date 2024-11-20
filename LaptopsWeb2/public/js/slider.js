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

// <!-- Thêm script xử lý click danh mục -->
let currentPage = 1;
let currentTypeId = null;
let currentTypeName = null;
let isLoading = false;

function loadProducts(typeId, typeName, productCount, page = 1) {
    if (productCount === 0) {
        alert('Không có sản phẩm của danh mục này!');
        return;
    }

    const productContainer = document.getElementById('products-container');
    if (page === 1) {
        productContainer.innerHTML = '<div class="text-center">Đang tải sản phẩm...</div>';
        currentTypeId = typeId;
        currentTypeName = typeName;
    }

    if (isLoading) return;
    isLoading = true;

    fetch(`/products/type/${typeId}?page=${page}`, {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'error') {
                alert(data.message);
                return;
            }

            if (productContainer) {
                let productsHtml = '';
                data.products.forEach(product => {
                    productsHtml += `
                    <div class="w-full max-w-sm mx-auto rounded-md shadow-md overflow-hidden border border-gray-300">
                        <div class="flex items-end justify-end h-56 w-full">
                            <img src="data:image;base64,${product.image}" alt="${product.name}" class="h-full w-full object-cover" />
                        </div>
                        <div class="px-5 py-3">
                            <h3 class="text-gray-700 uppercase">${product.name}</h3>
                            <span class="text-gray-500 mt-2 block">$${product.unit_price}</span>
                            <form action="/cart/add" method="POST" class="mt-4">
                                <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').getAttribute('content')}">
                                <input type="hidden" name="product_id" value="${product.id}">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
                                    Thêm vào giỏ hàng
                                </button>
                            </form>
                        </div>
                    </div>
                `;
                });

                if (page === 1) {
                    productContainer.innerHTML = `
                    <h3 class="text-gray-600 text-2xl font-medium">${typeName}</h3>
                    <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mt-6" id="products-grid">
                        ${productsHtml}
                    </div>
                    ${data.hasMore ? '<div class="text-center mt-8"><button id="load-more" class="bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-600 transition-colors">Load More</button></div>' : ''}
                `;
                } else {
                    document.getElementById('products-grid').insertAdjacentHTML('beforeend', productsHtml);
                    if (!data.hasMore) {
                        document.getElementById('load-more')?.remove();
                    }
                }

                if (page === 1) {
                    productContainer.scrollIntoView({ behavior: 'smooth' });
                }

                currentPage = data.nextPage;

                // Add event listener for load more button
                document.getElementById('load-more')?.addEventListener('click', () => {
                    loadProducts(currentTypeId, currentTypeName, productCount, currentPage);
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Có lỗi xảy ra khi tải sản phẩm');
        })
        .finally(() => {
            isLoading = false;
        });
}