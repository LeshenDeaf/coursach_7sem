import { api, DEVICE_TYPE, BRANCH_CODE } from '../../http/esplus/index';

const pad2 = num => num < 10 ? `0${num}` : num;

const getDatesQuery = () => {
    const date = new Date();

    return {
        period_from: `${pad2(date.getMonth() + 1)}.${date.getFullYear() - 1}`,
        period_to: `${pad2(date.getMonth() + 1)}.${date.getFullYear()}`
    }
}

export class StatisticsService {
    static apiLinks = {
        counters: kiesb => `/meter/list?account_id=KIESB|${kiesb}`,
        accruals: `/statistics/accruals`,
        refresh_accruals: `/refresh_accruals`,
    }

    static async accruals(mainNumber) {
        return api.get(
            StatisticsService.apiLinks.refresh_accruals,
            {
                params: {
                    account_id: `KIESB|${mainNumber}`,
                    ...getDatesQuery(),
                    limit: 12,
                    offset: 0,
                    branch_code: BRANCH_CODE,
                    user_type: 'individual'
                }
            }
        );
    }

}
