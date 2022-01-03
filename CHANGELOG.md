# CHANGELOG #
The project history of changes.

## 2022-01-03
### Modified
- Properly implement working dir on the python script

## 2022-01-01
### Added
- Implemented `set_title` for files visualization

## 2021-12-31
### Added
- Log requester's IP on screenshot request

### Modified
- Screenshot log file is now a unique log file

## 2021-12-30
### Added
- Basic SELF form interaction
- Set form as main home page, creating an `api` page
- `.php` extension is now implied
- `Legal notice` page
- Prepare `set_title` implementation

### Modified
- Added the new api route
- Configuration values are now fully functional on screenshot
- API headline now has a wiki link

### Fixed
- No given value in configuration test
- CHANGELOG inconsistency

## 2021-12-28
### Added
- Add prequirements to README

## 2021-12-27
### Added
- Project started
- Repository initialized
- Subdomain created (screenshot.jofaval.com)
- Create the `CHANGELOG.md`
- Detail the project in the `README.md`
  - Create `API.md` documentation
  - Add Legal notice
- Base project file structure and content
- Create base wiki pages
- Implement basic screenshotting scipt, functional. First with chrome
- Prepare python execution enviroment
- Implement debugging and logging systems
- Create screenshot basic script call
- Implement return format
- Delete screenshot after display

### Modified
- Secure the file delete
- Improve the default case

### Fixed
- Screenshot script failing because of incorrect route remapping