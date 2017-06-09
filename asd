SELECT
srp.id AS '#',
role.name AS 'GROUP/ROLE',
sm.name AS 'MODULE',
sf.name AS 'FUNCTION',
sp.name AS 'PERMISSION',
srp.active_status AS 'HAS PERMISSION?'
FROM system_role_permissions AS srp
LEFT JOIN system_modules AS sm ON srp.system_module_id = sm.id
LEFT JOIN system_functions AS sf ON srp.system_function_id = sf.id
LEFT JOIN system_permissions AS sp ON srp.system_permission_id = sp.id
LEFT JOIN groups AS role ON srp.role_id = role.id