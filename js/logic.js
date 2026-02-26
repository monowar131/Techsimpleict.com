// Logic for price calculations and validations
const LogicManager = {
    calculatePrice: (training, offers) => {
        const now = new Date().toISOString().split('T')[0];
        const activeOffer = offers.find(o =>
            o.trainingId === training.id &&
            now >= o.startDate &&
            now <= o.endDate
        );

        if (!activeOffer) return training.fee;

        if (activeOffer.discountType === 'Percentage') {
            return training.fee * (1 - activeOffer.value / 100);
        } else {
            return Math.max(0, training.fee - activeOffer.value);
        }
    },

    isRegistrationOpen: (training) => {
        const now = new Date().toISOString().split('T')[0];
        return now <= training.deadline;
    },

    getFormattedDate: (dateStr) => {
        const date = new Date(dateStr);
        return date.toLocaleDateString('en-GB', { day: '2-digit', month: 'short', year: 'numeric' });
    }
};
