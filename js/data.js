// Data structure for trainings and offers (interacting with PHP APIs)
const DataManager = {
    getTrainings: async () => {
        const response = await fetch('api/get_trainings.php');
        return await response.json();
    },
    getTrainingDetails: async (id) => {
        const response = await fetch(`api/get_training_details.php?id=${id}`);
        return await response.json();
    },
    getClassifications: async () => {
        const response = await fetch('api/get_classifications.php');
        return await response.json();
    },
    saveRegistration: async (formData) => {
        const response = await fetch('api/register.php', {
            method: 'POST',
            body: formData
        });
        return await response.json();
    },
    // Admin functions
    admin: {
        login: async (username, password) => {
            const formData = new FormData();
            formData.append('username', username);
            formData.append('password', password);
            const response = await fetch('api/login.php', {
                method: 'POST',
                body: formData
            });
            return await response.json();
        },
        signup: async (email, password) => {
            const formData = new FormData();
            formData.append('email', email);
            formData.append('password', password);
            const response = await fetch('api/signup.php', {
                method: 'POST',
                body: formData
            });
            return await response.json();
        },
        forgotPassword: async (email, newPassword) => {
            const formData = new FormData();
            formData.append('email', email);
            formData.append('new_password', newPassword);
            const response = await fetch('api/reset_password.php', {
                method: 'POST',
                body: formData
            });
            return await response.json();
        },
        getTrainings: async () => {
            const response = await fetch('api/admin/trainings.php');
            return await response.json();
        },
        saveTraining: async (training) => {
            const method = training.id ? 'PUT' : 'POST';
            const response = await fetch('api/admin/trainings.php', {
                method: method,
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(training)
            });
            return await response.json();
        },
        deleteTraining: async (id) => {
            const response = await fetch(`api/admin/trainings.php?id=${id}`, {
                method: 'DELETE'
            });
            return await response.json();
        },
        getOffers: async () => {
            const response = await fetch('api/admin/offers.php');
            return await response.json();
        },
        saveOffer: async (offer) => {
            const response = await fetch('api/admin/offers.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(offer)
            });
            return await response.json();
        },
        deleteOffer: async (id) => {
            const response = await fetch(`api/admin/offers.php?id=${id}`, {
                method: 'DELETE'
            });
            return await response.json();
        },
        getRegistrations: async () => {
            const response = await fetch('api/admin/registrations.php');
            return await response.json();
        }
    }
};
