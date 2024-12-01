const thumbnails = [
    'https://fiverr-res.cloudinary.com/images/t_main1,q_auto,f_auto,q_auto,f_auto/gigs/400367980/original/794c2acd1eb2284c79ae57461604e57792270619/create-stunning-modern-flyer-design-business-card-brochures-or-booklets.png',
    'https://fiverr-res.cloudinary.com/images/t_main1,q_auto,f_auto,q_auto,f_auto/gigs3/400367980/original/4c66d4320573d0f5f51b7c9b2300c6808e78d16d/create-stunning-modern-flyer-design-business-card-brochures-or-booklets.png',
    'https://fiverr-res.cloudinary.com/images/t_main1,q_auto,f_auto,q_auto,f_auto/gigs2/400367980/original/6769585035395452a495f7dadfec0ed778def274/create-stunning-modern-flyer-design-business-card-brochures-or-booklets.png',
    'https://fiverr-res.cloudinary.com/images/t_main1,q_auto,f_auto,q_auto,f_auto/gigs/274737734/original/638aeb871506eb6b722c6aaaa3dd39ff12ea5dec/design-stunning-professional-flyer-for-your-business.png',
    'https://fiverr-res.cloudinary.com/images/t_smartwm/t_gig_pdf_gallery_view_ver4,q_auto,f_auto/v1/attachments/delivery/asset/7df0a8dd5c370b5ac5281904d778b8f7-1622151870/flyer%20page%201%20view%20only/create-a-stunning-poster-or-flyer.pdf'
];

const categories = [
    'Flyer Design',
    'Brochure Design',
    'Social Media',
    'Marketing Material',
    'Print Design'
];

const aboutContent = {
    description: "Create a attractive, selling and strategical design. Here for reduce downtime and more profit of your business.",
    highlights: [
        "High Quality: Supreme Design",
        "Unlimited Revisions: Unlimited times",
        "Fast Project Design: Typically under 24 hours",
        "Service Guarantee: 100% money back"
    ]
};

const deliveryFormats = [
    'PDF',
    'JPEG',
    'PNG',
    'AI',
    'PSD'
];

const reviews = [
    {
        name: "John Brown",
        avatar: "https://via.placeholder.com/40",
        rating: 5,
        comment: "Excellent work! Very professional and quick delivery."
    },
    {
        name: "Sarah K.",
        avatar: "https://via.placeholder.com/40",
        rating: 4.5,
        comment: "Great communication and quality design."
    }
];

// const recommendedServices = [
//     {
//         title: "Logo Design",
//         image: "https://via.placeholder.com/250",
//         price: "$99"
//     },
//     {
//         title: "Business Card Design",
//         image: "https://via.placeholder.com/250",
//         price: "$49"
//     },
//     {
//         title: "Social Media Kit",
//         image: "https://via.placeholder.com/250",
//         price: "$149"
//     }
// ];

// Render Functions
function renderThumbnails() {
    const grid = document.getElementById('thumbnailGrid');
    thumbnails.forEach(src => {
        const img = document.createElement('img');
        img.src = src;
        img.className = 'thumbnail';
        img.alt = 'Portfolio thumbnail';
        grid.appendChild(img);
    });
}

function renderCategories() {
    const grid = document.getElementById('categoriesGrid');
    categories.forEach(category => {
        const div = document.createElement('div');
        div.className = 'category-card';
        div.textContent = category;
        grid.appendChild(div);
    });
}

function renderAboutContent() {
    const container = document.getElementById('aboutContent');
    const description = document.createElement('p');
    description.textContent = aboutContent.description;
    container.appendChild(description);

    const ul = document.createElement('ul');
    aboutContent.highlights.forEach(highlight => {
        const li = document.createElement('li');
        li.textContent = highlight;
        ul.appendChild(li);
    });
    container.appendChild(ul);
}

function renderDeliveryFormats() {
    const container = document.getElementById('deliveryFormats');
    deliveryFormats.forEach(format => {
        const div = document.createElement('div');
        div.className = 'format-card';
        div.textContent = format;
        container.appendChild(div);
    });
}

function renderReviews() {
    const container = document.getElementById('reviewsContainer');
    reviews.forEach(review => {
        const div = document.createElement('div');
        div.className = 'review-card';
        div.innerHTML = `
            <div class="review-header">
                <img src="${review.avatar}" alt="${review.name}" class="reviewer-avatar">
                <div>
                    <div class="reviewer-name">${review.name}</div>
                    <div class="rating">
                        ${'★'.repeat(Math.floor(review.rating))}${review.rating % 1 ? '½' : ''}
                    </div>
                </div>
            </div>
            <div class="review-comment">${review.comment}</div>
        `;
        container.appendChild(div);
    });
}

// function renderRecommended() {
//     const grid = document.getElementById('recommendedGrid');
//     recommendedServices.forEach(service => {
//         const div = document.createElement('div');
//         div.className = 'recommended-card';
//         div.innerHTML = `
//             <img src="${service.image}" alt="${service.title}">
//             <div class="recommended-info">
//                 <div class="recommended-title">${service.title}</div>
//                 <div class="recommended-price">Starting at ${service.price}</div>
//             </div>
//         `;
//         grid.appendChild(div);
//     });
// }

// Initialize all sections
document.addEventListener('DOMContentLoaded', () => {
    renderThumbnails();
    renderCategories();
    renderAboutContent();
    renderDeliveryFormats();
    renderReviews();
    // renderRecommended();
});