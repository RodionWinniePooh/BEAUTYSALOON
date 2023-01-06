SELECT full_name, CAST((Service.duration_service + Visit.time_of_visit) as time)
        from Employee INNER JOIN Service INNER JOIN visit ON visit.id_service = service.id_service 
		group by full_name HAVING full_name not in
        (
            (select full_name from Employee inner join Visit 
                on Employee.id_employee = Visit.id_employee
                where  Visit.date_of_visit = '2019-12-21' and Visit.time_of_visit = '12:00'
                group by full_name)
        ) AND '12:00' > time AND '12:00' < Visiti.time_of_visit
