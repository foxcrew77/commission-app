Summary:
2 views
4 queries


--view for delivery_trip_lorry_details which has capacity, plate_no and outlet information
CREATE 
    ALGORITHM = UNDEFINED 
    DEFINER = `root`@`localhost` 
    SQL SECURITY DEFINER
VIEW `delivery_trip_lorry_details` AS
    SELECT 
        `delivery_trip_lorry_details`.`delivery_trip_id` AS `delivery_trip_id`,
        `delivery_trip_lorry_details`.`lorry_id` AS `lorry_id`,
        `delivery_trip_lorry_details`.`plate_no` AS `plate_no`,
        `delivery_trip_lorry_details`.`outlet` AS `outlet`,
        `delivery_trip_lorry_details`.`capacity` AS `capacity`,
        `delivery_trip_lorry_details`.`status` AS `status`
    FROM
        (SELECT 
            `delivery_trip_lorry`.`delivery_trip_id` AS `delivery_trip_id`,
                `delivery_trip_lorry`.`lorry_id` AS `lorry_id`,
                `lorries`.`plate_no` AS `plate_no`,
                `lorries`.`outlet` AS `outlet`,
                `lorries`.`capacity` AS `capacity`,
                `lorries`.`status` AS `status`
        FROM
            (`delivery_trip_lorry`
        LEFT JOIN `lorries` ON ((`delivery_trip_lorry`.`lorry_id` = `lorries`.`id`)))) `delivery_trip_lorry_details`


-- convert the following into views:
--daily entry for workman
select trip_date,driver_id,capacity,total_weight
from delivery_trip_lorry_details
left join `commission-app`.delivery_trips on `commission-app`.delivery_trips.id = delivery_trip_lorry_details.delivery_trip_id 
left join `commission-app`.delivery_trip_driver on `commission-app`.delivery_trips.id = `commission-app`.delivery_trip_driver.delivery_trip_id
where driver_id is not NULL and
trip_date like '2024-04%' and
driver_id = 57
order by driver_id, trip_date


--daily total weight for all driver, group by capacity
select trip_date,driver_id,capacity,sum(total_weight) from delivery_trip_lorry_details
left join `commission-app`.delivery_trips on `commission-app`.delivery_trips.id = delivery_trip_lorry_details.delivery_trip_id 
left join `commission-app`.delivery_trip_driver on `commission-app`.delivery_trips.id = `commission-app`.delivery_trip_driver.delivery_trip_id
where driver_id is not NULL
group by trip_date,driver_id,capacity
order by driver_id, trip_date

--with commission column
select trip_date,driver_id,capacity,sum(total_weight),
(case when ( sum(total_weight) > capacity and capacity > 2200 ) then ((sum(total_weight)-capacity)*0.008)*0.4
when ( sum(total_weight) > capacity and capacity < 2500 ) then ((sum(total_weight)-capacity)*0.008)*0.5
when ( sum(total_weight) < capacity) then 0
    end) as daily_commission
from delivery_trip_lorry_details
left join `commission-app`.delivery_trips on `commission-app`.delivery_trips.id = delivery_trip_lorry_details.delivery_trip_id 
left join `commission-app`.delivery_trip_driver on `commission-app`.delivery_trips.id = `commission-app`.delivery_trip_driver.delivery_trip_id
where driver_id is not NULL
group by trip_date,driver_id,capacity
order by driver_id, trip_date

--monthly commission per driver
select driver_id, round(sum(daily_commission),2) as monthly_commission from 
(
select trip_date,driver_id,capacity,sum(total_weight),
(case when ( sum(total_weight) > capacity and capacity > 2200 ) then ((sum(total_weight)-capacity)*0.008)*0.4
when ( sum(total_weight) > capacity and capacity < 2500 ) then ((sum(total_weight)-capacity)*0.008)*0.5
when ( sum(total_weight) < capacity) then 0
    end) as daily_commission
from delivery_trip_lorry_details
left join `commission-app`.delivery_trips on `commission-app`.delivery_trips.id = delivery_trip_lorry_details.delivery_trip_id 
left join `commission-app`.delivery_trip_driver on `commission-app`.delivery_trips.id = `commission-app`.delivery_trip_driver.delivery_trip_id
where driver_id is not NULL
group by trip_date,driver_id,capacity
order by driver_id, trip_date
) as daily_commission
where
trip_date like concat('%','2021-02','%') and
    driver_id = 1
    -- group by commID

--monthly commission per driver + driver commission as workman (can be separated or combined by remove the sum(..) and modify the group by)
-- select Driver,sum(Driver_Total_Commission.Commission) from
select name as Driver, Commission from
(
select Driver,sum(Driver_Total_Commission.Commission) as Commission from
-- select Driver,Driver_Total_Commission.Commission from
(
(
select driver_id as Driver, round(sum(daily_commission),2) as Commission from 
(
select trip_date,driver_id,capacity,sum(total_weight),
(case when ( sum(total_weight) > capacity and capacity > 2200 ) then ((sum(total_weight)-capacity)*0.008)*0.4
when ( sum(total_weight) > capacity and capacity < 2500 ) then ((sum(total_weight)-capacity)*0.008)*0.5
when ( sum(total_weight) < capacity) then 0
    end) as daily_commission
from delivery_trip_lorry_details
left join `commission-app`.delivery_trips on `commission-app`.delivery_trips.id = delivery_trip_lorry_details.delivery_trip_id 
left join `commission-app`.delivery_trip_driver on `commission-app`.delivery_trips.id = `commission-app`.delivery_trip_driver.delivery_trip_id
where driver_id is not NULL
group by trip_date,driver_id,capacity
order by driver_id, trip_date
) as daily_commission
where
trip_date like concat('%','2024-04','%')
and daily_commission <> 0.00
-- and driver_id = 12
group by driver_id
)

UNION ALL

(
select asWorkman_id as Driver, round(sum(daily_commission),2) as Commission from 
(
select trip_date,asWorkman_id,capacity,sum(total_weight) as TW,
(case when ( sum(total_weight) > capacity and capacity > 2200 ) then ((sum(total_weight)-capacity)*0.008)*0.3
when ( sum(total_weight) > capacity and capacity < 2500 ) then ((sum(total_weight)-capacity)*0.008)*0.5
when ( sum(total_weight) < capacity) then 0
    end) as daily_commission
from delivery_trip_lorry_details
left join `commission-app`.delivery_trips on `commission-app`.delivery_trips.id = delivery_trip_lorry_details.delivery_trip_id 
left join `commission-app`.delivery_trip_asWorkman_id on `commission-app`.delivery_trips.id = `commission-app`.delivery_trip_asWorkman_id.delivery_trip_id
where workman_id is not NULL
group by trip_date,workman_id,capacity
order by workman_id, trip_date
) as daily_commission
where
trip_date like concat('%','2024-04','%') 
and daily_commission <> 0.00
-- and asWorkman_id = 12
group by asWorkman_id
) 
) as Driver_Total_Commission
where Driver_Total_Commission.Driver is not null
group by Driver_Total_Commission.Driver
-- group by Driver_Total_Commission.Driver,Driver_Total_Commission.Commission
) as TotalWorkmancomm
left join `commission-app`.drivers on TotalWorkmancomm.driver = `commission-app`.drivers.id
where TotalWorkmancomm.Driver <> 0
order by `commission-app`.drivers.id asc


--daily entry for workman
select trip_date,workman_id,capacity,total_weight
from delivery_trip_lorry_details
left join `commission-app`.delivery_trips on `commission-app`.delivery_trips.id = delivery_trip_lorry_details.delivery_trip_id 
left join `commission-app`.delivery_trip_workman on `commission-app`.delivery_trips.id = `commission-app`.delivery_trip_workman.delivery_trip_id
where workman_id is not NULL and
trip_date like '2024-04%' and
workman_id = 57
order by workman_id, trip_date

--*** Driver Monthly Commission
select driver_id as Driver, round(sum(daily_commission),2) as Commission from 
(
select trip_date,driver_id,capacity,sum(total_weight),
(case when ( sum(total_weight) > capacity and capacity > 2200 ) then ((sum(total_weight)-capacity)*0.008)*0.4
when ( sum(total_weight) > capacity and capacity < 2500 ) then ((sum(total_weight)-capacity)*0.008)*0.5
when ( sum(total_weight) < capacity) then 0
    end) as daily_commission
from delivery_trip_lorry_details
left join `commission-app`.delivery_trips on `commission-app`.delivery_trips.id = delivery_trip_lorry_details.delivery_trip_id 
left join `commission-app`.delivery_trip_driver on `commission-app`.delivery_trips.id = `commission-app`.delivery_trip_driver.delivery_trip_id
where driver_id is not NULL
group by trip_date,driver_id,capacity
order by driver_id, trip_date
) as daily_commission
where
trip_date like concat('%','2024-04','%')
and daily_commission <> 0.00
-- and driver_id = 1
group by driver_id

--------------------------------------------------------------------------------

--daily total weight for all workman, group by capacity
select trip_date,workman_id,capacity,sum(total_weight) from delivery_trip_lorry_details
left join `commission-app`.delivery_trips on `commission-app`.delivery_trips.id = delivery_trip_lorry_details.delivery_trip_id 
left join `commission-app`.delivery_trip_workman on `commission-app`.delivery_trips.id = `commission-app`.delivery_trip_workman.delivery_trip_id
where workman_id is not NULL
group by trip_date,workman_id,capacity
order by workman_id, trip_date

--with commission column
select trip_date,workman_id,capacity,sum(total_weight),
(case when ( sum(total_weight) > capacity and capacity > 2200 ) then ((sum(total_weight)-capacity)*0.008)*0.4
when ( sum(total_weight) > capacity and capacity < 2500 ) then ((sum(total_weight)-capacity)*0.008)*0.5
when ( sum(total_weight) < capacity) then 0
    end) as daily_commission
from delivery_trip_lorry_details
left join `commission-app`.delivery_trips on `commission-app`.delivery_trips.id = delivery_trip_lorry_details.delivery_trip_id 
left join `commission-app`.delivery_trip_workman on `commission-app`.delivery_trips.id = `commission-app`.delivery_trip_workman.delivery_trip_id
where workman_id is not NULL
group by trip_date,workman_id,capacity
order by workman_id, trip_date

--monthly commission per workman without commission from driver as workman
select workman_id, round(sum(daily_commission),2) as monthly_commission from 
(
select trip_date,workman_id,capacity,sum(total_weight),
(case when ( sum(total_weight) > capacity and capacity > 2200 ) then ((sum(total_weight)-capacity)*0.008)*0.3
when ( sum(total_weight) > capacity and capacity < 2500 ) then ((sum(total_weight)-capacity)*0.008)*0.5
when ( sum(total_weight) < capacity) then 0
    end) as daily_commission
from delivery_trip_lorry_details
left join `commission-app`.delivery_trips on `commission-app`.delivery_trips.id = delivery_trip_lorry_details.delivery_trip_id 
left join `commission-app`.delivery_trip_workman on `commission-app`.delivery_trips.id = `commission-app`.delivery_trip_workman.delivery_trip_id
where workman_id is not NULL
group by trip_date,workman_id,capacity
order by workman_id, trip_date
) as daily_commission
where
trip_date like concat('%','2021-02','%') and
    workman_id = 16

--*** Workman Monthly Commission
select workman_id as Workman, round(sum(daily_commission),2) as Commission from 
(
select trip_date,workman_id,capacity,sum(total_weight) as TW,
(case when ( sum(total_weight) > capacity and capacity > 2200 ) then ((sum(total_weight)-capacity)*0.008)*0.3
when ( sum(total_weight) > capacity and capacity < 2500 ) then ((sum(total_weight)-capacity)*0.008)*0.5
when ( sum(total_weight) < capacity) then 0
    end) as daily_commission
from delivery_trip_lorry_details
left join `commission-app`.delivery_trips on `commission-app`.delivery_trips.id = delivery_trip_lorry_details.delivery_trip_id 
left join `commission-app`.delivery_trip_workman on `commission-app`.delivery_trips.id = `commission-app`.delivery_trip_workman.delivery_trip_id
where workman_id is not NULL
group by trip_date,workman_id,capacity
order by workman_id, trip_date
) as daily_commission
where
trip_date like concat('%','2024-04','%') 
and daily_commission <> 0.00
-- and workman_id = 57
group by workman_id


--query for delivery_trip_asWorkman_id view. this view combine workmen and delivery_trip_workmen table which shows the asWorkman_id column
select * from `commission-app`.workmen
left join `commission-app`.delivery_trip_workman on `commission-app`.workmen.id = `commission-app`.delivery_trip_workman.workman_id




--by outlet, commission
select name as Workman, Commission from
(
select workman_id as Workman, round(sum(daily_commission),2) as Commission from 
(
select trip_date,workman_id,capacity,sum(total_weight) as TW,
(case when ( sum(total_weight) > capacity and capacity > 2200 ) then ((sum(total_weight)-capacity)*0.008)*0.3
when ( sum(total_weight) > capacity and capacity < 2500 ) then ((sum(total_weight)-capacity)*0.008)*0.5
when ( sum(total_weight) < capacity) then 0
    end) as daily_commission
from delivery_trip_lorry_details
left join `commission-app`.delivery_trips on `commission-app`.delivery_trips.id = delivery_trip_lorry_details.delivery_trip_id 
left join `commission-app`.delivery_trip_workman on `commission-app`.delivery_trips.id = `commission-app`.delivery_trip_workman.delivery_trip_id
where workman_id is not NULL
and delivery_trip_lorry_details.outlet = 'KKIP'
group by trip_date,workman_id,capacity
order by workman_id, trip_date
) as daily_commission
where
trip_date like concat('%','2022-01','%') 
and daily_commission <> 0.00
-- and workman_id = 38
group by workman_id
) as workmancomm
left join `commission-app`.Workmen on workmancomm.Workman = `commission-app`.Workmen.id


<table class="w-full whitespace-no-wrap"> 
    <thead>
    <tr
        class="text-xs font-semibold tracking-wide text-gray-500 uppercase border dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
    >
        <th class="px-4 py-3 text-center" colspan="4">KKIP Commission</th>
    </tr>
    <tr
        class="text-xs font-semibold tracking-wide text-gray-500 uppercase border dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
    >
        <th class="px-4 py-3 border" colspan="2">Driver</th>
        <th class="px-4 py-3 border" colspan="2">Workman</th>
    </tr>
    </thead>
    <tbody
    class="bg-white divide-y dark:divide-gray-700 border dark:bg-gray-800 text-sm"
    >
    {{-- first row --}}
    <tr class="text-gray-700 dark:text-gray-400">
        <td class="px-4 py-3 font-semibold border">
                Hans Burger
        </td>
        <td class="px-4 py-3 text-sm">
        $ 863.45
        </td>
        <td class="px-4 py-3 font-semibold border">
            Hans Burger
    </td>
    <td class="px-4 py-3 text-sm">
    $ 863.45
    </td>
    </tr>
    {{-- second row --}}
    <tr class="text-gray-700 dark:text-gray-400">
        <td class="px-4 py-3 font-semibold border">
                Hans Burger
        </td>
        <td class="px-4 py-3 text-sm">
        $ 863.45
        </td>
        <td class="px-4 py-3 font-semibold border">
            Hans Burger
    </td>
    <td class="px-4 py-3 text-sm">
    $ 863.45
    </td>
    </tr>
    </tbody>
</table>