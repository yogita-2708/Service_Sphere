<?php include_once "include/navbar.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>
    <style>
        .aboutcontainer{
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
            position: relative;
            margin-top: 100vh;
        }
        .wholeaboutcontainer {
            background-color: rgba(128, 128, 128, 0.4);
            overflow-x: hidden;
        }
        .aboutcontainer p{
            text-align:justify;
        }
        .bg-img {
            height: 100vh;
            width: 100vw;
            overflow-x: hidden;
            position: absolute;
            top: 0;
            left: 0;
            z-index: -1;
            background: url('images/about3.webp');
            background-size: cover;
            background-position: center;
        }
        .sec-one {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
        }

        .text{
            border-bottom: 2px solid black;
            width:10%;
        }
        @media (max-width: 571px) {
            .bg-img {
                height: 50vh;
            }
            .aboutcontainer {
                margin-top: 50vh;
                width: 80%;
            }
        }


    </style>
</head>
<body class="wholeaboutcontainer">

<div class="bg-img"><div class="sec-one"></div></div>

    <div class="container aboutcontainer">
        <h2 class="text-center text-dark fw-bold mt-2 mt-md-4">EXPERIENCE</h2>
        <hr class="text mx-auto">
        <div class="row">
            <div class="col-md-6 container p-3 p-md-4">
                <h6 class="fw-bold">More Than 1 Years Of Experience</h6>
                <p>
                    Welcome to Service Sphere, your premier destination for a wide range of services designed to simplify your life. As a newly launched platform, we're dedicated to connecting you with top-notch service providers in various sectors, including home services, car repairs, and beyond. At Service Sphere, we understand the value of convenience and quality, which is why we've curated a network of trusted professionals to cater to your every need. <br> Whether you're looking to spruce up your living space with our home services or ensure your vehicle is running smoothly with our expert car repair options, we've got you covered. Our mission is to streamline the process of finding reliable service providers, allowing you to focus on what matters most to you. Join us on this journey as we strive to redefine the way you experience convenience and excellence in service.
                </p>
            </div>
            <div class="col-md-6 container p-3 p-md-4">
                <h6 class="fw-bold">Friendly And professional Services</h6>
                <p>
                    At Service Sphere, we pride ourselves on delivering friendly and professional services that exceed your expectations. Our dedicated team is committed to providing a seamless experience from start to finish, ensuring that every interaction with us leaves you satisfied and delighted. Whether you're seeking assistance with home maintenance, car repairs, or any other service within our repertoire, you can trust that our experts will handle your needs with care and expertise. <br> We prioritize clear communication, transparent pricing, and a customer-centric approach in everything we do. With Service Sphere, you can rest assured that you're in capable hands, receiving service that is not only efficient and reliable but also delivered with a smile. Welcome to a new standard of excellence in service provision.
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 container mt-2 mt-md-5">
                <h2 class="text-center fw-bold text-dark mt-2 mt-md-4">OUR VISION AND MISSION</h2>
                <hr class="text mx-auto">
                <figure class="text-center mb-2 mb-md-4">
                    <blockquote class="blockquote">
                        <p class="text-center">"Achieving greatness in service requires a commitment to constant improvement and unwavering dedication."</p>
                    </blockquote>
                    <figcaption class="blockquote-footer">
                        <cite title="Source Title">David Rodriguez</cite>
                    </figcaption>
                </figure>
                <p class="mb-3 mb-md-3">
                    At Service Sphere, our goal is simple yet profound: to revolutionize the service industry by seamlessly connecting individuals with reliable professionals while prioritizing convenience, transparency, and excellence. Our mission is to redefine the standards of service provision, ensuring that every interaction with us leaves a lasting impression of satisfaction and trust.
                </p>
                <p class="mb-3">Through innovation, dedication, and a customer-centric approach, we strive to empower both service providers and seekers, creating a dynamic ecosystem where efficiency and quality converge to enrich lives. Join us on our journey as we transform the way services are accessed and experienced, one satisfied customer at a time.</p>
            </div>
        </div>

        <div class="row mb-5">
            <div class="col-md-6">
                <p>At Service Sphere, we are committed to excellence in every aspect of our operations. From vetting top-tier service providers to facilitating seamless transactions, our dedication to quality permeates every interaction. We believe in setting high standards and exceeding them, ensuring that each service experience is nothing short of exceptional. With a relentless pursuit of excellence, we continuously strive to elevate the service industry and set new benchmarks for customer satisfaction.</p>
            </div>
            <div class="col-md-6">
                <p>Our platform serves as more than just a bridge between service providers and seekers—it's a catalyst for meaningful connections. Whether it's finding the perfect handyman for home repairs or a skilled mechanic for car maintenance, Service Sphere fosters connections that go beyond transactions, fostering trust, reliability, and mutual respect. Together, we're building a community where service seekers can find peace of mind and service providers can showcase their expertise with pride.</p>
            </div>
        </div>
    </div>

</body>
</html>
<?php include_once "include/footer.php"; ?>