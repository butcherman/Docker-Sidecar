import { faker } from "@faker-js/faker";
import { far } from "@fortawesome/free-regular-svg-icons";

const iconKeys = Object.keys(far);

export const useSampleData = () => {
    const sampleList = (recordCount: number) => {
        let list = [];

        for (let i = 0; i < recordCount; i++) {
            list.push({
                name: faker.person.fullName(),
                username: faker.internet.username(),
                email: faker.internet.email(),
            });
        }

        return list;
    };

    const sampleTableData = (recordCount: number) => {
        let list = [];

        for (let i = 0; i < recordCount; i++) {
            const randomKey =
                iconKeys[Math.floor(Math.random() * iconKeys.length)];
            const randomIcon = far[randomKey];

            list.push({
                text: faker.word.sample(),
                bool: faker.datatype.boolean(),
                size: faker.number.bigInt(),
                date: faker.date.anytime(),
                phone: faker.phone.number(),
                icon: randomIcon.iconName,
            });
        }

        return list;
    };

    return {
        sampleList,
        sampleTableData,
    };
};
