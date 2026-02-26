// Data structure for trainings and offers
const initialTrainings = [
    {
        id: 'ts-001',
        title: 'Full Stack Bootcamp',
        code: 'TS-001',
        category: 'Professional',
        fee: 15000,
        instructor: 'Dr. John Smith',
        startDate: '2026-05-01',
        deadline: '2026-04-20',
        status: 'Upcoming',
        description: 'Comprehensive boot camp covering frontend, backend, and DevOps.'
    },
    {
        id: 'ts-002',
        title: 'UI/UX Design Masterclass',
        code: 'TS-002',
        category: 'Certification',
        fee: 12000,
        instructor: 'Jane Doe',
        startDate: '2026-06-15',
        deadline: '2026-06-01',
        status: 'Upcoming',
        description: 'Master the art of user interface and experience design with modern tools.'
    },
    {
        id: 'ts-003',
        title: 'Cybersecurity Fundamentals',
        code: 'TS-003',
        category: 'Corporate',
        fee: 20000,
        instructor: 'Alice Johnson',
        startDate: '2026-07-10',
        deadline: '2026-06-25',
        status: 'Upcoming',
        description: 'Learn the essentials of cybersecurity and how to protect digital assets.'
    }
];

const initialOffers = [
    {
        id: 'offer-001',
        name: 'New Year Discount',
        trainingId: 'ts-001',
        discountType: 'Percentage',
        value: 10,
        startDate: '2026-01-01',
        endDate: '2026-03-31'
    }
];

// Utility functions
const DataManager = {
    getTrainings: () => {
        const stored = localStorage.getItem('trainings');
        return stored ? JSON.parse(stored) : initialTrainings;
    },
    saveTrainings: (trainings) => {
        localStorage.setItem('trainings', JSON.stringify(trainings));
    },
    getOffers: () => {
        const stored = localStorage.getItem('offers');
        return stored ? JSON.parse(stored) : initialOffers;
    },
    saveOffers: (offers) => {
        localStorage.setItem('offers', JSON.stringify(offers));
    },
    getRegistrations: () => {
        const stored = localStorage.getItem('registrations');
        return stored ? JSON.parse(stored) : [];
    },
    saveRegistration: (registration) => {
        const regs = DataManager.getRegistrations();
        regs.push({ ...registration, date: new Date().toISOString().split('T')[0] });
        localStorage.setItem('registrations', JSON.stringify(regs));
    },
    getAdminUsers: () => {
        const stored = localStorage.getItem('adminUsers');
        return stored ? JSON.parse(stored) : [];
    },
    saveAdminUser: (user) => {
        const users = DataManager.getAdminUsers();
        users.push(user);
        localStorage.setItem('adminUsers', JSON.stringify(users));
    },
    updateAdminPassword: (email, newPassword) => {
        const users = DataManager.getAdminUsers();
        const index = users.findIndex(u => u.email === email);
        if (index !== -1) {
            users[index].password = newPassword;
            localStorage.setItem('adminUsers', JSON.stringify(users));
            return true;
        }
        return false;
    }
};

// Initialize if empty
if (!localStorage.getItem('trainings')) DataManager.saveTrainings(initialTrainings);
if (!localStorage.getItem('offers')) DataManager.saveOffers(initialOffers);
