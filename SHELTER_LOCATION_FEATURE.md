# Shelter Location Assignment Feature

## Overview
This feature allows System Admins to assign specific NCR shelter locations to Shelter Admin accounts. When a Shelter Admin logs in, they only see and manage data (pets, applications, analytics) for their assigned shelter location.

## Implementation Summary

### 1. Database Changes
- **Migration**: `2025_10_16_120029_add_shelter_location_to_users_table.php`
- Added `shelter_location` column to `users` table (nullable string)
- Stores the assigned NCR city shelter name (e.g., "Muntinlupa Shelter")

### 2. User Model Updates
**File**: `app/Models/User.php`

Added:
- `shelter_location` to `$fillable` array
- `getShelterLocations()` static method - returns array of 17 NCR shelter locations:
  - Manila Shelter, Quezon City Shelter, Makati Shelter, Pasig Shelter, Taguig Shelter
  - Mandaluyong Shelter, San Juan Shelter, Pasay Shelter, Parañaque Shelter
  - Las Piñas Shelter, Muntinlupa Shelter, Caloocan Shelter, Malabon Shelter
  - Navotas Shelter, Valenzuela Shelter, Marikina Shelter, Pateros Shelter
- `hasShelterLocation()` method - checks if user has assigned shelter location

### 3. Create Admin Form
**File**: `resources/views/admin/system/users/create.blade.php`

Changes:
- Added Shelter Location dropdown field (hidden by default)
- JavaScript toggle: Shows dropdown only when "Shelter Admin" role is selected
- Dropdown populated from `User::getShelterLocations()`
- Field is required when Shelter Admin role is selected
- Helper text: "This admin will only manage pets and applications from this shelter"

### 4. System Admin Controller
**File**: `app/Http/Controllers/Admin/SystemAdminController.php`

Updated `storeUser()` method:
- Added conditional validation for `shelter_location` (required for shelter_admin role)
- Validates against `User::getShelterLocations()` array
- Saves `shelter_location` to database for Shelter Admin users

### 5. Shelter Admin Dashboard
**File**: `app/Http/Controllers/Admin/ShelterAdminController.php`

Updated `index()` method:
- Filters all pets by `location = user->shelter_location`
- Filters applications via `whereHas('pet')` relationship
- Dashboard statistics reflect only the assigned shelter's data

### 6. Pet Management
**File**: `app/Http/Controllers/Admin/PetController.php`

Updated `index()` method:
- Automatically filters pets by shelter_location for Shelter Admins
- System Admins see all pets across all locations
- Location dropdown filter disabled for Shelter Admins (they only see their location)

### 7. Application Management
**File**: `app/Http/Controllers/Admin/AdoptionApplicationController.php`

Updated `index()` method:
- Filters applications by checking pet's location via relationship
- Statistics calculated only for assigned shelter location
- Shelter Admins cannot see applications for other shelters

### 8. Analytics Controller
**File**: `app/Http/Controllers/Admin/AnalyticsController.php`

Major updates:
- Added `$userLocation` property to store current user's shelter location
- Added middleware to set `$userLocation` on controller initialization
- Created helper methods:
  - `applyLocationFilter($query)` - filters Pet queries by location
  - `applyLocationFilterToApplications($query)` - filters Application queries via pet relationship

Updated all analytics methods to respect location filter:
- `getOverviewStats()` - total/available/adopted pets, all applications
- `calculateAdoptionRate()` - adoption percentage for shelter
- `getAdoptionTrends()` - applications over time
- `getPetTypeStats()` - dog/cat breakdown
- `getApplicationStatusStats()` - pending/approved/rejected counts
- `getPopularBreeds()` - breed statistics
- `getCapacityData()` - current capacity and maximums
- `getAtRiskPets()` - pets with 7+ days in shelter
- `getLengthOfStayData()` - stay duration distribution
- `exportApplications()` - CSV export filtered by location
- `exportPets()` - CSV export filtered by location

## Testing Instructions

### 1. Create a Test Shelter Admin
1. Navigate to: http://localhost:8000/admin/system/users/create
2. Enter admin details:
   - Name: Keisha Martinez
   - Email: keisha@muntinlupashelter.com
   - Password: password123
3. Select "Shelter Admin" role
4. Choose "Muntinlupa Shelter" from dropdown
5. Click "Create Admin"

### 2. Verify Location Assignment
1. Go to User Management: http://localhost:8000/admin/system/users
2. Confirm "Muntinlupa Shelter" appears in the shelter admin's row

### 3. Test Shelter Admin Dashboard
1. Logout and login as: keisha@muntinlupashelter.com
2. Navigate to: http://localhost:8000/admin/shelter/dashboard
3. **Expected Results**:
   - Total Pets count shows only Muntinlupa pets
   - Recent Pets list shows only Muntinlupa pets
   - Application statistics for Muntinlupa only

### 4. Test Pet Management
1. Navigate to: http://localhost:8000/admin/pets
2. **Expected Results**:
   - Only Muntinlupa pets displayed
   - Location filter dropdown shows only "Muntinlupa Shelter"
   - Cannot see pets from other shelters

### 5. Test Application Management
1. Navigate to: http://localhost:8000/admin/applications
2. **Expected Results**:
   - Only applications for Muntinlupa pets shown
   - Statistics reflect Muntinlupa data only
   - Cannot access applications for pets in other shelters

### 6. Test Analytics
1. Navigate to: http://localhost:8000/admin/shelter/analytics
2. **Expected Results**:
   - All charts and statistics filtered to Muntinlupa data
   - Capacity shows Muntinlupa capacity only
   - At-Risk Pets from Muntinlupa only
   - Adoption trends for Muntinlupa only

## Data Flow

```
System Admin Creates Shelter Admin
    ↓
Assigns "Muntinlupa Shelter" location
    ↓
Saves to users.shelter_location column
    ↓
Shelter Admin Logs In
    ↓
Middleware/Controllers check auth()->user()->shelter_location
    ↓
All queries filtered by: WHERE location = 'Muntinlupa Shelter'
    ↓
Dashboard/Pets/Applications/Analytics show only Muntinlupa data
```

## Security Considerations

1. **Authorization**: Shelter Admins cannot bypass location filter
2. **Query Level**: Filtering applied at database query level, not view level
3. **Relationship Filtering**: Applications filtered via pet relationship (secure)
4. **Validation**: Shelter location validated against predefined list
5. **Immutable**: Shelter admins cannot change their own location

## Future Enhancements

1. **Edit User Form**: Add ability to change shelter admin's location
2. **Multi-Location Support**: Allow admins to manage multiple shelters
3. **Database Capacity**: Store max capacities in database instead of hardcoded array
4. **Location Hierarchy**: Support regions/districts beyond individual cities
5. **Transfer Functionality**: Move pets between shelter locations with audit log

## Files Modified

1. `database/migrations/2025_10_16_120029_add_shelter_location_to_users_table.php` (NEW)
2. `app/Models/User.php` (UPDATED)
3. `resources/views/admin/system/users/create.blade.php` (UPDATED)
4. `app/Http/Controllers/Admin/SystemAdminController.php` (UPDATED)
5. `app/Http/Controllers/Admin/ShelterAdminController.php` (UPDATED)
6. `app/Http/Controllers/Admin/PetController.php` (UPDATED)
7. `app/Http/Controllers/Admin/AdoptionApplicationController.php` (UPDATED)
8. `app/Http/Controllers/Admin/AnalyticsController.php` (UPDATED)

## NCR Shelter Locations

The following 17 NCR shelter locations are available:

1. Manila Shelter
2. Quezon City Shelter
3. Makati Shelter
4. Pasig Shelter
5. Taguig Shelter
6. Mandaluyong Shelter
7. San Juan Shelter
8. Pasay Shelter
9. Parañaque Shelter
10. Las Piñas Shelter
11. Muntinlupa Shelter
12. Caloocan Shelter
13. Malabon Shelter
14. Navotas Shelter
15. Valenzuela Shelter
16. Marikina Shelter
17. Pateros Shelter

## Troubleshooting

### Issue: Shelter admin sees all pets
**Solution**: Clear cache - `php artisan cache:clear && php artisan view:clear`

### Issue: Location dropdown not appearing
**Solution**: Check JavaScript console for errors, ensure role radio button has correct value

### Issue: Analytics not filtering
**Solution**: Verify user has `shelter_location` set in database, check `hasShelterLocation()` returns true

### Issue: Applications not filtered
**Solution**: Ensure Pet model has `location` column and relationship is properly loaded with `->with(['pet'])`
