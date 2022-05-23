import { StatisticsService } from "../../services/ESPlus/StatisticsService";
import {AuthService} from "../../services/ESPlus/AuthService";

$('.get_main_number').on('click', async function () {
    const result = await AuthService.me();

    console.log(result.data)

    $(this).replace(`<h1>${result.data.mainNumber}</h1>`)
})

$('.refresh_accruals').on('click', async function () {
    const result = await StatisticsService.accruals($(this).attr('name'));

    console.log(result.data);
});

