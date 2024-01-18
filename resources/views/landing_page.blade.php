<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تقدُم</title>
    <link rel="icon" href="{{asset('/assets/images/logo1.png')}}">
    <link rel="stylesheet" href="{{asset('/assets/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/css/solid.min.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/css/landing_page.css')}}">
</head>
<!-- // animation-hidden -->

<body>
    <!-- Home section -->
    <section id="home" class="hero ">
        <nav class="navbar navbar-expand-lg fixed-top w-100 py-3" style="z-index: 1024;">
            <div class="container">
                <a class="navbar-brand" href="#home">
                    <img src="{{asset('/assets/images/logo1.png')}}" alt="Bootstrap" width="50" height="50">
                    تقدُم
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                    <ul class="navbar-nav  mb-2 mb-lg-0 fs-5">
                        <li class="nav-item ps-lg-4">
                            <a class="nav-link nav-link-css" href="#about">حولنا</a>
                        </li>
                        <li class="nav-item ps-lg-4">
                            <a class="nav-link nav-link-css" href="#stats">إحصائيات</a>
                        </li>
                        <li class="nav-item ps-lg-4">
                            <a class="nav-link nav-link-css" href="#programs">برامجنا</a>
                        </li>
                        <li class="nav-item ps-lg-4">
                            <a class="nav-link nav-link-css" href="#faq">الأسئلة الشائعة</a>
                        </li>
                        <li class="nav-item ps-lg-4">
                            <a class="nav-link nav-link-css" href="#partner">شركاؤنا</a>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>
        <div class="container animation-hidden">
            <div class="hero-content col-lg-6">
                <p class="heading display-3 fw-bold ">اكتسب المهارات والمعرفة مع تطبيقنا الرائع</p>
                <p class="body fs-5">استفد من برامج تدريبية مميزة تقدمها أفضل الخبراء في مجالات متنوعة. قم بالتسجيل الآن
                    وابدأ رحلتك نحو التطوير المهني.</p>
                <div class="mt-3 d-flex gap-4 flex-wrap">
                    <button type="button" class="btn btn-primary btn-lg col-sm-4 col-12 rounded-5 p-3 fw-bold"><a href="/app/register" class="nav-link" target="_blank">التسجيل
                        الأن</a></button>
                    <button type="button" class="btn btn-secondary btn-lg col-sm-4 col-12 rounded-5 p-3"><a href="/app/login" class="nav-link" target="_blank">تسجيل
                        الدخول</a></button>
                </div>
            </div>
        </div>
    </section>

    <!-- About section -->
    <section id="about" class="container py-5 my-5">
        <div class="my-5 py-5">
            <div class="animation-hidden about-heading mb-5">
                <h2 class="text-center fs-5 fw-bold">حولنا</h2>
                <p class="fs-1 fw-bold text-center">من نحن</p>
                <p class="text-center fs-5"> نحن نعتزم تقديم أفضل البرامج التدريبية عبر الإنترنت للمحترفين الطموحين.
                    تطبيقنا يقدم فرصة للأفراد لاكتساب المهارات والمعرفة الضرورية في مختلف المجالات من خلال برامج تدريبية
                    مصممة خصيصًا لتلبية احتياجاتكم.
                </p>
            </div>
            <div class="d-flex flex-column flex-lg-row animation-hidden about-body" style="gap: 28px;">
                <div>
                    <div class="mb-4 icons"><i class="fa fa-eye fa-4x"></i>
                    </div>
                    <p class="text-center fw-bold fs-4" style="color: var(--primary-1);">رؤيتنا</p>
                    <p class="text-center fs-5" style="color: var(--gray);">
                        تتجسد رؤيتنا في توفير منصة تعلم مبتكرة وملهمة، تجمع بين أحدث التقنيات وأفضل المحتويات التدريبية.
                        نطمح إلى أن نكون رائدين في تقديم فرص التعلم عبر الإنترنت، مساهمين في تحويل حياة الأفراد من خلال
                        تحقيق إمكانياتهم الكاملة.
                    </p>
                </div>
                <div>
                    <div class="mb-4 icons">
                        <i class="fa fa-message fa-4x"></i>
                    </div>
                    <p class="text-center fw-bold fs-4" style="color: var(--primary-1);">رسالتنا</p>
                    <p class="text-center fs-5" style="color: var(--gray);">
                        في تقدُم، نتفهم أهمية التعلم المستمر والتطوير الشخصي. نسعى جاهدين لتوفير بيئة تعلم تحفز الإبداع
                        وتمكنك من تحقيق أهدافك المهنية. نحن هنا لدعم رحلتك في اكتساب المهارات وتحقيق التفوق.
                    </p>
                </div>
                <div>
                    <div class="icons mb-4"><i class="fas fa-bullseye fa-4x"></i>
                    </div>
                    <p class="fs-4 text-center fw-bold fs-4" style="color: var(--primary-1);">أهدافنا</p>
                    <p class="text-center fs-5" style="color: var(--gray);">
                        في تقدُم، نسعى لتحقيق عدة أهداف، بما في ذلك توفير تجارب تعلم ممتازة، وتطوير مجتمع تعلم
                        متكامل، وتمكين الأفراد للنجاح في مساراتهم المهنية. نعمل بجد لتقديم محتوى متنوع وفعّال يلبي
                        احتياجات جميع متعلمينا.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- Stats section -->
    <section id="stats" class="container py-5 my-5">
        <div class="my-5 py-5">
            <div class="animation-hidden stas-heading mb-5">
                <h2 class="fs-1" style="color: var(--primary-1);">إحصائيات</h2>
                <p class="fs-5" style="color: var(--gray);">نتائجنا بالارقام</p>
            </div>
            <div class="grid-container animation-hidden">
                <div class="grid-item p-5 rounded-4 item">
                    <div style="display: flex;justify-content:flex-end;height: 100%; flex-direction: column;">
                        <div class="rounded-4 p-4 mb-5"
                            style="background-color: var(--white); color: var(--primary-1);width: max-content;">
                            <i class="fa-solid fa-arrow-up-right-dots fa-3x"></i>
                        </div>
                        <p class="fw-bold fs-3" style="color: var(--white);">إجمالي البرامج</p>
                        <p class="fw-bold display-1" style="color: var(--white);">{{$program_count}}
                            {{-- <span style="color: var(--primary-1);">الف</span> --}}
                        </p>
                    </div>

                </div>
                <div class="rounded-4 item p-4">
                    <div class="rounded-4 p-3 my-3"
                        style="background-color: var(--primary-1); color: var(--primary-1);width: max-content;">
                        <i class="fa-solid fa-users fa-2x" style="color: var(--primary-2);"></i>
                    </div>
                    <p class="fs-5 fw-bold mb-0" style="color: var(--gray);">عدد المستخدمين</p>
                    <p class="display-2 fw-bold " style="color:var(--primary-1);">{{$applicant_count}}
                        {{-- <span style="color: var(--primary-2);">الف</span> --}}
                    </p>
                </div>
                <div class="rounded-4 item p-4">
                    <div class="rounded-4 p-3 my-3"
                        style="background-color: var(--primary-1); color: var(--primary-1);width: max-content;">
                        <i class="fa-solid fa-layer-group fa-2x" style="color: var(--primary-2);"></i>
                    </div>
                    <p class="fs-5 fw-bold mb-0" style="color: var(--gray);">مجموع الطلبات المقدمة</p>
                    <p class="display-2 fw-bold " style="color:var(--primary-1);">{{$application_count}}
                        {{-- <span style="color: var(--primary-2);">الف</span> --}}
                    </p>
                </div>
                <div class="rounded-4 item p-4">
                    <div class="rounded-4 p-3 my-3"
                        style="background-color: var(--primary-1); color: var(--primary-1);width: max-content;">
                        <i class="fa-solid fa-graduation-cap fa-2x" style="color: var(--primary-2);"></i>
                    </div>
                    <p class="fs-5 fw-bold mb-0" style="color: var(--gray);">الطلاب المستفيدين من برامجنا</p>
                    <p class="display-2 fw-bold " style="color:var(--primary-1);">{{$accept_applications}}
                        {{-- <span style="color: var(--primary-2);">الف</span> --}}
                    </p>
                </div>
                <div class="rounded-4 item p-4">
                    <div class="rounded-4 p-3 my-3"
                        style="background-color: var(--primary-1); color: var(--primary-1);width: max-content;">
                        <i class="fa-solid fa-paper-plane fa-2x" style="color: var(--primary-2);"></i>
                    </div>
                    <p class="fs-5 fw-bold mb-0" style="color: var(--gray);">البرامج المتاحة</p>
                    <p class="display-2 fw-bold " style="color:var(--primary-1);">{{$available_program}}
                        {{-- <span  style="color: var(--primary-2);">الف</span> --}}
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- Programs section -->
    <section id="programs" class="container py-5 my-5">
        <div class="py-5 my-5">
            <div class="animation-hidden programs-heading mb-5">
                <h2 class="fs-1" style="color: var(--primary-1);">برامجنا</h2>
                <p class="fs-5" style="color: var(--gray);">مجموعة متنوعة من البرامج التدريبية التي تغطي مجالات حيوية في
                    عالم التكنولوجيا والهندسة. تتميز هذه البرامج بأنها تقدم فرصًا للمستخدمين لتطوير مهاراتهم وتحسين
                    أدائهم في مجالات محددة.</p>
            </div>
            <div class="program animation-hidden">

                @foreach ($programs as $item)
                <div class="p-5">
                    <h3 class="fs-4 mb-4">{{$item->name}}</h3>
                    <p class="fs-5">{{$item->description}}</p>
                    <img src="{{asset("/storage//".$item->image)}}" alt="">
                </div>
                @endforeach

            </div>
        </div>
    </section>
    <!-- FAQ -->
    <section id="faq" class="container py-5 my-5">
        <div class="py-5 my-5">
            <div class="animation-hidden faq-heading mb-5">
                <h2 class="fs-1" style="color: var(--primary-1);">الأسئلة الشائعة</h2>
                <p class="fs-5" style="color: var(--gray);">يحتوي هذا القسم على مجموعة متنوعة من الأسئلة التي قد تكون في
                    أذهان المستخدمين أثناء تفاعلهم مع تقدُم. تشمل الأسئلة المعتادة حول عملية التسجيل، الوصول إلى
                    البرامج التدريبية، وكيفية التفاعل مع منصتنا.</p>
            </div>
            <div class="faq animation-hidden">

            @foreach ($faqs as $item)
            <div class="box p-5 mb-4" onclick="toggles(this)">
                <div class="top-box fs-4">
                    <h3>{{$item->question}}</h3>
                    <span><i class="fa-solid fa-greater-than"></i></span>
                </div>
                <p class="toggle-text fs-5 pt-3" style="display:none">{{$item->answer}}</p>
            </div>
            @endforeach

            </div>
        </div>
    </section>
    <!-- partners -->
    <section id="partner" class="container py-5 my-5">
        <div class="py-5 my-5">
            <div class="mb-5 animation-hidden">
                <h2 class="fs-1 text-center" style="color: var(--primary-1);">شركاؤنا</h2>
            </div>
            <div class="partner animation-hidden">
                <div class="slider">
                    <div class="slides">
                        <img src="{{asset('/assets/images/hf-logo.svg')}}" alt="">
                        <img src="{{asset('/assets/images/giz-logo.gif')}}" alt="">
                        <img src="{{asset('/assets/images/logo.svg')}}" alt="">
                        <img src="{{asset('/assets/images/logo1.png')}}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- footer -->
    <hr>
    <div id="footer" class="container py-5 my-5">
        <div class="parent">
            <div class="first">
                <div>
                    <img src="{{asset('/assets/images/logo1.png')}}" alt="" width="50" heigth="50">
                    <span class="fw-bold fs-4" style="color:var(--primary-1)">تقدُم</span>
                </div>
                <p class="fs-5 py-4" style="color:var(--gray)">
                    استفد من برامج تدريبية مميزة تقدمها أفضل الخبراء في مجالات متنوعة. قم بمتابعتنا على مواقع التواصل
                    الاجتماعي</p>
                <div class="social">
                    <span class="ms-3"><i class="fa-brands fa-facebook fs-5"></i></span>
                    <span class="ms-3"><i class="fa-brands fa-instagram fs-5"></i></span>
                    <span class="ms-3"><i class="fa-brands fa-twitter fs-5"></i></span>
                </div>
            </div>
            <div class="second">
                <p class="fs-4 fw-bold mb-4" style="color:var(--primary-1)">تواصل معنا</p>
                <div class="box px-4 py-3 mb-4">
                    <div class="box-icon ms-4"><i class="fa-regular fa-envelope fs-3"></i></div>
                    <div>
                        <p class="fs-5">الإيميل:</p>
                        <p class="fs-5 fw-bold">a.3.shater@gmail.com</p>
                    </div>
                </div>
                <div class="box px-4 py-3">
                    <div class="box-icon ms-4"><i class="fa-regular fa-envelope fs-3"></i></div>
                    <div>
                        <p class="fs-5">الهاتف:</p>
                        <p class="fs-5 fw-bold">77x xxx xxx</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div id="copy_rights" class="text-center pb-4 fs-5">
        حقوق الملكية &copy; 2024 <span>Ahmed Ali</span> | جميع الحقوق محفوظة
    </div>
    <script src="{{asset('/assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('/assets/js/landing_page.js')}}"></script>
</body>

</html>