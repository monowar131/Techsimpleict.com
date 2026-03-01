<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Training Programs | TechSimple ICT</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .user-nav {
            background: #1e293b;
            padding: 1rem 2rem;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .user-nav a {
            color: white;
            text-decoration: none;
            margin-left: 1rem;
        }

        .filter-section {
            padding: 2rem;
            background: white;
            margin-bottom: 2rem;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .training-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2rem;
        }

        .training-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease;
            position: relative;
        }

        .training-card:hover {
            transform: translateY(-5px);
        }

        .card-content {
            padding: 1.5rem;
        }

        .badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .badge-Certification {
            background: #dcfce7;
            color: #166534;
        }

        .badge-Professional {
            background: #dbeafe;
            color: #1e40af;
        }

        .badge-Corporate {
            background: #fef3c7;
            color: #92400e;
        }

        .price {
            font-size: 1.25rem;
            font-weight: 700;
            color: #10b981;
        }

        .old-price {
            text-decoration: line-through;
            color: #94a3b8;
            font-size: 0.9rem;
            margin-right: 0.5rem;
        }

        .offer-tag {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: #ef4444;
            color: white;
            padding: 0.2rem 0.6rem;
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: 700;
        }
    </style>
</head>

<body style="background: #f8fafc; padding: 0;">
    <nav class="user-nav">
        <h1>TechSimple ICT</h1>
        <div>
            <a href="trainings.html">Trainings</a>
            <a href="index.html">Admin</a>
        </div>
    </nav>

    <main style="max-width: 1200px; margin: 0 auto; padding: 2rem;">
        <header style="margin-bottom: 3rem;">
            <h1 style="font-size: 2.5rem; color: #1e293b;">Ignite Your Career</h1>
            <p style="color: #64748b;">Expert-led training programs designed for the future.</p>
        </header>

        <section class="filter-section">
            <span style="font-weight: 600;">Filter by:</span>
            <select id="categoryFilter"
                style="padding: 0.5rem; border-radius: 6px; border: 1px solid #e2e8f0; width: 200px;">
                <option value="All">All Categories</option>
                <option value="Certification">Certification</option>
                <option value="Professional">Professional</option>
                <option value="Corporate">Corporate</option>
            </select>
        </section>

        <div id="trainingGrid" class="training-grid">
            <!-- Dynamic Content -->
        </div>
    </main>

    <script src="js/data.js"></script>
    <script src="js/logic.js"></script>
    <script>
        const grid = document.getElementById('trainingGrid');
        const filter = document.getElementById('categoryFilter');

        async function renderTrainings() {
            const trainings = await DataManager.getTrainings();
            const selectedCategory = filter.value;

            grid.innerHTML = '';

            trainings
                .filter(t => selectedCategory === 'All' || t.category === selectedCategory)
                .forEach(t => {
                    const finalPrice = LogicManager.calculatePrice(t);
                    const hasOffer = finalPrice < parseFloat(t.price);

                    const card = `
                        <div class="training-card">
                            ${hasOffer ? '<div class="offer-tag">ACTIVE OFFER</div>' : ''}
                            <div class="card-content">
                                <span class="badge badge-${t.category}">${t.category}</span>
                                <h3 style="margin-bottom: 0.5rem; color: #1e293b;">${t.title}</h3>
                                <p style="color: #64748b; font-size: 0.9rem; margin-bottom: 1rem; height: 3.6rem; overflow: hidden;">${t.description}</p>
                                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.5rem;">
                                    <div>
                                        ${hasOffer ? `<span class="old-price">৳${parseFloat(t.price).toLocaleString()}</span>` : ''}
                                        <span class="price">৳${finalPrice.toLocaleString()}</span>
                                    </div>
                                    <span style="font-size: 0.8rem; color: #94a3b8;">Deadline: ${LogicManager.getFormattedDate(t.deadline)}</span>
                                </div>
                                <a href="training-detail.php?id=${t.id}" class="btn" style="width: 100%; text-align: center; text-decoration: none;">View Details</a>
                            </div>
                        </div>
                    `;
                    grid.innerHTML += card;
                });
        }

        filter.addEventListener('change', renderTrainings);
        renderTrainings();
    </script>
</body>

</html>