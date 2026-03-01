// Logic for price calculations and validations
const LogicManager = {
    calculatePrice: (training) => {
        const fee = parseFloat(training.price);
        if (!training.discount_value) return fee;

        if (training.discount_type === 'percentage') {
            return fee * (1 - parseFloat(training.discount_value) / 100);
        } else {
            return Math.max(0, fee - parseFloat(training.discount_value));
        }
    },

    isRegistrationOpen: (training) => {
        const now = new Date();
        const deadline = new Date(training.deadline);
        return now <= deadline;
    },

    getFormattedDate: (dateStr) => {
        const date = new Date(dateStr);
        return date.toLocaleDateString('en-GB', { day: '2-digit', month: 'short', year: 'numeric' });
    }
};
