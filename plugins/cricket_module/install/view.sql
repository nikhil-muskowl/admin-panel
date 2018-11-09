-- cricket_team_matches_view
CREATE OR REPLACE ALGORITHM = UNDEFINED
VIEW `cricket_team_matches_view`
AS
SELECT ctm.*,cm.name AS match_name,ct.name AS team_name FROM cricket_team_matches ctm
LEFT JOIN cricket_matches cm ON cm.id=ctm.match_id
LEFT JOIN cricket_teams ct ON ct.id=ctm.team_id;

-- cricket_players_view
CREATE OR REPLACE ALGORITHM = UNDEFINED
VIEW `cricket_players_view`
AS
SELECT cp.*,ct.name AS team_name,ctt.name AS type_name,cbtt.name AS batting_type,cblt.name AS bowlling_type 
FROM cricket_players cp
LEFT JOIN cricket_teams ct ON ct.id=cp.team_id
LEFT JOIN cricket_tournament_types ctt ON ctt.id=cp.type_id
LEFT JOIN cricket_batting_types cbtt ON cbtt.id=cp.batting_type_id
LEFT JOIN cricket_bowlling_types cblt ON cblt.id=cp.bowlling_type_id;

-- cricket_bowllings_view
CREATE OR REPLACE ALGORITHM = UNDEFINED
VIEW `cricket_bowllings_view`
AS
SELECT cb.*,cm.name as match_name,ct.name AS team_name,cp.name AS player_name FROM cricket_bowllings cb
LEFT JOIN cricket_matches cm ON cm.id=cb.match_id
LEFT JOIN cricket_teams ct ON ct.id=cb.team_id
LEFT JOIN cricket_players cp ON cp.id=cb.player_id;

-- cricket_battings_view
CREATE OR REPLACE ALGORITHM = UNDEFINED
VIEW `cricket_battings_view`
AS
SELECT cb.*,cm.name as match_name,ct.name AS team_name,cp.name AS player_name FROM cricket_battings cb
LEFT JOIN cricket_matches cm ON cm.id=cb.match_id
LEFT JOIN cricket_teams ct ON ct.id=cb.team_id
LEFT JOIN cricket_players cp ON cp.id=cb.player_id;

-- cricket_team_points_view
CREATE OR REPLACE ALGORITHM = UNDEFINED
VIEW `cricket_team_points_view`
AS
SELECT ctp.*,ct.name AS team_name,cp.name AS player_name FROM cricket_team_points ctp
LEFT JOIN cricket_teams ct ON ct.id=ctp.team_id
LEFT JOIN cricket_players cp ON cp.id=ctp.player_id;

-- cricket_player_roles_view
CREATE OR REPLACE ALGORITHM = UNDEFINED
VIEW `cricket_player_roles_view`
AS
SELECT cpr.*,cp.name AS player_name,cr.name AS role_name,cr.short_name AS role_short_name FROM cricket_player_roles cpr
LEFT JOIN cricket_players cp ON cp.id=cpr.player_id
LEFT JOIN cricket_roles cr ON cr.id=cpr.role_id;

-- cricket_player_levels_view
CREATE OR REPLACE ALGORITHM = UNDEFINED
VIEW `cricket_player_levels_view`
AS
SELECT cpl.*,cp.name AS player_name,ctl.name AS level_name FROM cricket_player_levels cpl
LEFT JOIN cricket_players cp ON cp.id=cpl.player_id
LEFT JOIN cricket_tournament_levels ctl ON ctl.id=cpl.level_id;
