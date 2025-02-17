<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>R911 - Anime</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2c3e50;
            --accent-color: #e74c3c;
            --background-color: #f0f2f5;
            --card-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --transition-speed: 0.3s;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Figtree', sans-serif;
            line-height: 1.6;
            color: #333;
            background: var(--background-color);
            padding-top: 70px;
        }

        /* Enhanced Navbar */
        .navbar {
            background: linear-gradient(90deg, rgba(40, 32, 113, 0.98), rgba(135, 46, 223, 0.9));
            backdrop-filter: blur(10px);
            padding: 1rem 2rem;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }


        .nav-content {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
            color: white;
        }

        .logo-icon {
            font-size: 1.8rem;
            color: var(--primary-color);
            animation: pulse 2s infinite;
        }

        .logo-text {
            font-size: 1.5rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            background: linear-gradient(45deg, #3498db, #2ecc71);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .nav-links {
            display: flex;
            gap: 1.5rem;
            align-items: center;
        }

        .nav-link {
            color: white;
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 500;
            transition: var(--transition-speed);
            position: relative;
        }

        .nav-link:before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 2px;
            background: var(--primary-color);
            transition: var(--transition-speed);
        }

        .nav-link:hover:before {
            width: 80%;
        }

        .nav-link.primary {
            background: var(--primary-color);
        }

        .nav-link.primary:hover {
            background: #2980b9;
            transform: translateY(-2px);
        }

        /* Categories Section */
        .categories {
            max-width: 1200px;
            margin: 2rem auto;
            display: flex;
            gap: 1rem;
            padding: 1rem;
            overflow-x: auto;
            scrollbar-width: none;
        }

        .categories::-webkit-scrollbar {
            display: none;
        }

        .category-tag {
            padding: 0.75rem 1.5rem;
            background: white;
            border-radius: 25px;
            white-space: nowrap;
            cursor: pointer;
            transition: var(--transition-speed);
            font-weight: 500;
            box-shadow: var(--card-shadow);
        }

        .category-tag:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-2px);
        }

        /* Anime Grid */
        .trending {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .section-title {
            font-size: 2rem;
            margin-bottom: 2rem;
            color: var(--secondary-color);
            font-weight: 700;
            position: relative;
            padding-left: 1rem;
        }

        .section-title::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 4px;
            height: 70%;
            background: var(--primary-color);
            border-radius: 2px;
        }

        .anime-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 2rem;
        }

        .anime-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            transition: all var(--transition-speed);
            box-shadow: var(--card-shadow);
            position: relative;
        }

        .anime-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
        }

        .anime-cover {
            width: 100%;
            height: 320px;
            object-fit: cover;
            transition: var(--transition-speed);
        }

        .anime-card:hover .anime-cover {
            transform: scale(1.05);
        }

        .anime-info {
            padding: 1.5rem;
            background: linear-gradient(to bottom, transparent, rgba(0,0,0,0.8));
            position: absolute;
            bottom: 0;
            width: 100%;
            color: white;
        }

        .anime-title {
            font-weight: 700;
            margin-bottom: 0.5rem;
            font-size: 1.2rem;
        }

        .anime-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.9rem;
        }

        .anime-meta span {
            background: rgba(0,0,0,0.5);
            padding: 0.25rem 0.75rem;
            border-radius: 15px;
            font-size: 0.8rem;
        }

        /* Mobile Menu Button */
        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
            transition: var(--transition-speed);
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .mobile-menu-btn {
                display: block;
            }

            .nav-links {
                display: none;
                position: absolute;
                top: 100%;
                left: 0;
                width: 100%;
                background: rgba(40, 32, 113, 0.98);
                backdrop-filter: blur(10px);
                padding: 1rem;
                flex-direction: column;
                align-items: center;
            }

            .nav-links.active {
                display: flex;
            }

            .nav-link {
                width: 100%;
                text-align: center;
                padding: 1rem;
            }

            .nav-link:before {
                display: none;
            }

            .nav-link:hover {
                background: linear-gradient(90deg, rgba(40, 32, 113, 0.98), rgba(135, 46, 223, 0.9))
            }

            .anime-grid {
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            }

            .section-title {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="nav-content">
            <a href="/" class="logo">
                <i class="fa fa-image" aria-hidden="true"></i>
                <span class="logo-text">Rule911</span>
            </a>
            
            <button class="mobile-menu-btn">
                <i class="fas fa-bars"></i>
            </button>

            <div class="nav-links">
                <a href="#home" class="nav-link">Home</a>
                @if (Route::has('login'))
                    @auth
                        <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>
                    @else
                        <a href="{{ url('/login') }}" class="nav-link">Login</a>
                        @if (Route::has('register'))
                            <a href="{{ url('/register') }}" class="nav-link">Register</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <div class="main-content">
        <div class="categories">
            <div class="category-tag" onclick="filterByCategory('all')">All</div>
            <div class="category-tag" onclick="filterByCategory('Art')">Art</div>
            <div class="category-tag" onclick="filterByCategory('Ai')">AI</div>
            <div class="category-tag" onclick="filterByCategory('Censor')">Censor</div>
            <div class="category-tag" onclick="filterByCategory('Uncensored')">Uncensored</div>
        </div>

        <div class="trending">
            <h2 class="section-title">Trending Now</h2>
            <div id="anime-grid" class="anime-grid">
                @foreach($posts as $post)
                    <div class="anime-card" data-category="{{ $post->type }}">
                        <a href="{{ $post->link }}" target="_blank" rel="noopener noreferrer">
                            @if ($post->image)
                                <img src="{{ asset('storage/' . $post->image) }}" alt="Anime Cover" class="anime-cover">
                            @else
                                <img src="/api/placeholder/250/320" alt="Anime Cover" class="anime-cover">
                            @endif
                        </a>
                        <div class="anime-info">
                            <div class="anime-title">{{ $post->title }}</div>
                            <div class="anime-meta">
                                <span>{{ Str::limit($post->body, 50) }}</span>
                                <span>{{ $post->type }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        // Mobile menu toggle
        const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
        const navLinks = document.querySelector('.nav-links');
        
        mobileMenuBtn.addEventListener('click', () => {
            navLinks.classList.toggle('active');
            mobileMenuBtn.querySelector('i').classList.toggle('fa-bars');
            mobileMenuBtn.querySelector('i').classList.toggle('fa-times');
        });

        // Category filtering
        function filterByCategory(category) {
            const cards = document.querySelectorAll('.anime-card');
            
            cards.forEach(card => {
                const cardCategory = card.getAttribute('data-category');
                
                if (category === 'all' || cardCategory === category) {
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                    setTimeout(() => {
                        card.style.display = 'block';
                    }, 50);
                } else {
                    card.style.opacity = '0';
                    card.style.transform = 'translateY(20px)';
                    setTimeout(() => {
                        card.style.display = 'none';
                    }, 300);
                }
            });
        }

        // Close mobile menu when clicking outside
        document.addEventListener('click', (e) => {
            if (!e.target.closest('.navbar')) {
                navLinks.classList.remove('active');
                mobileMenuBtn.querySelector('i').classList.add('fa-bars');
                mobileMenuBtn.querySelector('i').classList.remove('fa-times');
            }
        });

        // Handle window resize
        window.addEventListener('resize', () => {
            if (window.innerWidth > 768) {
                navLinks.classList.remove('active');
                mobileMenuBtn.querySelector('i').classList.add('fa-bars');
                mobileMenuBtn.querySelector('i').classList.remove('fa-times');
            }
        });
    </script>
</body>
</html>