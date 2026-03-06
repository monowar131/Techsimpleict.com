<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Training Details | TechSimple ICT</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body style="background: #f8fafc; padding: 0;">
    <nav style="background: #1e293b; padding: 1rem 2rem; color: white;">
        <h1><a href="trainings.html" style="color: white; text-decoration: none;">TechSimple ICT</a></h1>
    </nav>

    <main id="detailView"
        style="max-width: 800px; margin: 4rem auto; padding: 2rem; background: white; border-radius: 15px; shadow: 0 4px 20px rgba(0,0,0,0.08);">
        <!-- Dynamic Content -->
    </main>

    <script src="js/data.js"></script>
    <script src="js/logic.js"></script>
    <script>
        const urlParams = new URLSearchParams(window.location.search);
        const trainingId = urlParams.get('id');
        const detailView = document.getElementById('detailView');

        async function renderDetails() {
            const training = await DataManager.getTrainingDetails(trainingId);

            if (!training || training.error) {
                detailView.innerHTML = '<h1>Training not found</h1>';
                return;
            }

            const finalPrice = LogicManager.calculatePrice(training);
            const isOpen = LogicManager.isRegistrationOpen(training);

            detailView.innerHTML = `
                <div style="margin-bottom: 2rem;">
                    <span style="background: #dbeafe; color: #1e40af; padding: 0.25rem 1rem; border-radius: 20px; font-weight: 600;">${training.category}</span>
                    <h1 style="font-size: 2.5rem; margin: 1rem 0; color: #1e293b;">${training.title}</h1>
                    <p style="color: #64748b; font-size: 1.1rem;">${training.description}</p>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 3rem; padding: 2rem; background: #f8fafc; border-radius: 12px;">
                    <div>
                        <p style="color: #94a3b8; font-size: 0.9rem; margin-bottom: 0.25rem;">Instructor</p>
                        <p style="font-weight: 600; color: #1e293b;">${training.instructor}</p>
                    </div>
                    <div>
                        <p style="color: #94a3b8; font-size: 0.9rem; margin-bottom: 0.25rem;">Start Date</p>
                        <p style="font-weight: 600; color: #1e293b;">${LogicManager.getFormattedDate(training.created_at)}</p>
                    </div>
                    <div>
                        <p style="color: #94a3b8; font-size: 0.9rem; margin-bottom: 0.25rem;">Program Fee</p>
                        <p style="font-weight: 700; color: #10b981; font-size: 1.5rem;">৳${finalPrice.toLocaleString()} ${finalPrice < parseFloat(training.price) ? `<small style="text-decoration: line-through; color: #94a3b8; font-size: 1rem;">৳${parseFloat(training.price).toLocaleString()}</small>` : ''}</p>
                    </div>
                    <div>
                        <p style="color: #94a3b8; font-size: 0.9rem; margin-bottom: 0.25rem;">Registration Deadline</p>
                        <p style="font-weight: 600; color: ${isOpen ? '#1e293b' : '#ef4444'};">${LogicManager.getFormattedDate(training.deadline)}</p>
                    </div>
                </div>

                ${isOpen ?
                    `<a href="register.php?id=${training.id}" class="btn" style="padding: 1rem 2rem; font-size: 1.1rem; text-decoration: none; text-align: center; display: block;">Proceed to Registration</a>` :
                    `<button class="btn" disabled style="padding: 1rem 2rem; font-size: 1.1rem; background: #94a3b8; width: 100%;">Registration Closed</button>`
                }
            `;
        }

        renderDetails();
    </script>
</body>

</html>