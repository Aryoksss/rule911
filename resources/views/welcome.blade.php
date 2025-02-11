<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AnimeLib - Your Anime Collection</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Figtree', sans-serif;
            line-height: 1.6;
            color: #333;
            background: #f0f2f5;
        }

        /* Navbar */
        .navbar {
            background: #2c3e50;
            padding: 1rem 2rem;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }

        .nav-content {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            color: white;
            font-size: 1.5rem;
            font-weight: 700;
        }

        .search-bar {
            flex: 1;
            max-width: 500px;
            margin: 0 2rem;
        }

        .search-bar input {
            width: 100%;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            border: none;
            outline: none;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            margin-left: 1.5rem;
            transition: color 0.3s;
        }

        .nav-links a:hover {
            color: #3498db;
        }

        /* Main Content */
        .main-content {
            margin-top: 4rem;
            padding: 2rem;
        }

        /* Categories */
        .categories {
            max-width: 1200px;
            margin: 2rem auto;
            display: flex;
            gap: 1rem;
            overflow-x: auto;
            padding: 1rem 0;
        }

        .category-tag {
            padding: 0.5rem 1rem;
            background: white;
            border-radius: 20px;
            white-space: nowrap;
            cursor: pointer;
            transition: background 0.3s;
        }

        .category-tag:hover {
            background: #3498db;
            color: white;
        }

        /* Anime Grid */
        .anime-grid {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 2rem;
            padding: 2rem 0;
        }

        .anime-card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            transition: opacity 0.4s ease, transform 0.3s ease;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .anime-card.hidden {
            opacity: 0;
            transform: scale(0.95);
            pointer-events: none;
        }


        .anime-card:hover {
            transform: translateY(-5px);
        }

        .anime-cover {
            width: 100%;
            height: 280px;
            object-fit: cover;
        }

        .anime-info {
            padding: 1rem;
        }

        .anime-title {
            font-weight: 600;
            margin-bottom: 0.5rem;
            font-size: 1.1rem;
        }

        .anime-meta {
            font-size: 0.9rem;
            color: #666;
            display: flex;
            justify-content: space-between;
        }

        /* Trending Section */
        .trending {
            max-width: 1200px;
            margin: 2rem auto;
            background: white;
            padding: 2rem;
            border-radius: 10px;
        }

        .section-title {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: #2c3e50;
        }

        /* Footer */
        .footer {
            background: #2c3e50;
            color: white;
            padding: 2rem;
            margin-top: 4rem;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }

        .footer-section h3 {
            margin-bottom: 1rem;
        }

        .footer-section a {
            color: #bdc3c7;
            text-decoration: none;
            display: block;
            margin-bottom: 0.5rem;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .nav-content {
                flex-direction: column;
                gap: 1rem;
            }

            .search-bar {
                margin: 1rem 0;
                width: 100%;
            }

            .nav-links {
                width: 100%;
                display: flex;
                justify-content: space-around;
            }

            .nav-links a {
                margin: 0;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="nav-content">
            <div class="logo">Rule911</div>
            <div class="search-bar">
                <input type="text" placeholder="Search anime...">
            </div>
            <div class="nav-links">
                <a href="#home">Home</a>
                {{-- <a href="#latest">Latest</a>
                <a href="#popular">Popular</a>
     --}}
                @if (Route::has('login'))
                    @auth
                        <a href="{{ route('dashboard') }}">Dashboard</a>
                    @else
                        <a href="{{ url('/login') }}">Login</a>
                        @if (Route::has('register'))
                            <a href="{{ url('/register') }}">Register</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </nav>
    

    <!-- Main Content -->
    <div class="main-content">
        <!-- Categories -->
        <div class="categories">
            <div class="category-tag" onclick="filterByCategory('all')">All</div>
            <div class="category-tag" onclick="filterByCategory('Art')">Art</div>
            <div class="category-tag" onclick="filterByCategory('Ai')">Ai</div>
            <div class="category-tag" onclick="filterByCategory('Censor')">Censor</div>
            <div class="category-tag" onclick="filterByCategory('Uncensored')">Uncensored</div>
        </div>
        

        <!-- Trending Section -->
        <div class="trending">
            <h2 class="section-title">Trending Now</h2>
            <div id="anime-grid" class="anime-grid">
                @foreach($posts as $post)
                    <div class="anime-card" data-category="{{ $post->type }}">
                        @if ($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" alt="Anime Cover" class="anime-cover">
                        @else
                            <img src="/api/placeholder/200/280" alt="Anime Cover" class="anime-cover">
                        @endif
                        <div class="anime-info">
                            <div class="anime-title">{{ $post->title }}</div>
                            <div class="anime-meta">
                                <span>Rating: {{ $post->body }}</span>
                                <span>{{ $post->type }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
    </div>

    <!-- Footer -->
    {{-- <footer class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <h3>About</h3>
                <a href="#">About Us</a>
                <a href="#">Contact</a>
                <a href="#">Terms of Service</a>
                <a href="#">Privacy Policy</a>
            </div>
            <div class="footer-section">
                <h3>Browse</h3>
                <a href="#">Popular Anime</a>
                <a href="#">Latest Updates</a>
                <a href="#">Seasonal Anime</a>
                <a href="#">Movies</a>
            </div>
            <div class="footer-section">
                <h3>Community</h3>
                <a href="#">Forums</a>
                <a href="#">News</a>
                <a href="#">Featured Articles</a>
                <a href="#">User Reviews</a>
            </div>
        </div>
    </footer> --}}

    <script>
        function filterByCategory(category) {
            let cards = document.querySelectorAll('.anime-card');
        
            cards.forEach(card => {
                let cardCategory = card.getAttribute('data-category');
        
                if (category === 'all' || cardCategory === category) {
                    // Tambahkan transisi untuk muncul
                    card.classList.remove('hidden');
                    setTimeout(() => {
                        card.style.display = 'block';
                    }, 300);
                } else {
                    // Tambahkan efek fade out sebelum menghilang
                    card.classList.add('hidden');
                    setTimeout(() => {
                        card.style.display = 'none';
                    }, 300);
                }
            });
        }
        </script>
        
        
</body>
</html>