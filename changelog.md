# PawPal – Release Tagging, Versioning, and Notes

This page documents the release management process for **PawPal: Smart Pet Adoption Platform**, including version control, tagging strategy, and release notes conventions.

---

## 1. Versioning Policy

PawPal follows the **Semantic Versioning (SemVer)** standard:

```
MAJOR.MINOR.PATCH
```

| Segment   | Description                                                           |
| --------- | --------------------------------------------------------------------- |
| **MAJOR** | Incompatible or breaking changes (e.g., redesign, database overhaul). |
| **MINOR** | Backward-compatible features or enhancements.                         |
| **PATCH** | Backward-compatible bug fixes or performance improvements.            |

**Examples:**

* `1.0.0` → Initial stable release
* `1.1.0` → Added new feature (e.g., Pet Recommendation System)
* `1.1.1` → Minor fix (e.g., bug in adoption form)

---

## 2. Tagging Convention

Each release is tagged in Git using the format:

```
v<MAJOR>.<MINOR>.<PATCH>
```

**Example Commands:**

```bash
git tag -a v1.0.0 -m "Initial release of PawPal"
git push origin v1.0.0
```

This ensures every release version is traceable and linked to its codebase snapshot.

---

## 3. Release Notes Template

Each version must include **release notes** that summarize the key changes.
Use the following structure for every release:

```
Release Version: vX.Y.Z  
Release Date: <MM/DD/YYYY>  
Author(s): <Team/Developer Name>  

### New Features
- List newly added modules or functionality.

### Improvements
- Enhancements or optimizations made to existing components.

### Bug Fixes
- Summary of resolved bugs or issues.

### Known Issues
- Remaining or newly discovered issues not yet addressed.
```

---

## 4. Example Release Notes

### **Version: v1.0.0**

**Date:** October 6, 2025
**Author(s):** PawPal Development Team

#### New Features

* Implemented user authentication (login, registration, logout).
* Pet listing and adoption request functionality.
* Admin dashboard for pet and application management.

#### Improvements

* Fully responsive layout for desktop and mobile.
* Optimized database schema for faster search and filtering.

#### Bug Fixes

* None (initial release).

#### Known Issues

* Email notifications not yet integrated.
* Admin analytics charts still in prototype phase.

---

## 5. Version History Summary

| Version   | Date       | Description                                     | Author/Team     |
| --------- | ---------- | ----------------------------------------------- | --------------- |
| **1.0.0** | 2025-10-06 | Initial stable release of PawPal platform.      | DIGI |
| **1.1.0** | TBD        | Added pet recommendation and filtering.         | DIGI |
| **1.2.0** | TBD        | Integrated chat system for adopters and admins. | DIGI |
| **1.2.1** | TBD        | Fixed adoption form submission error.           | DIGI |

---

## 6. Changelog Summary

For detailed updates per version, see:
[CHANGELOG.md]

---

## 7. Contribution Notes

When submitting pull requests for release updates:

1. Update the version number in the app configuration file.
2. Add a new section to the `CHANGELOG.md`.
3. Tag the release after merging to `main`.
4. Update this Wiki page (if applicable).

---

**Maintained by:**
**DIGI**
*Last Updated: October 6, 2025*
