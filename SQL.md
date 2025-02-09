# SQL Query Performance Improvement

## Overview
The original SQL query retrieves data from multiple tables related to jobs, job categories, job types, and various affiliations (e.g., personalities, skills, tools, etc.). While functional, the query has several performance bottlenecks, such as excessive joins, inefficient filtering with `LIKE '%...%'`, and lack of indexing. This document outlines the identified issues and proposed improvements to optimize the query.

---

## Key Issues in the Original Query

1. **Multiple `LIKE '%...%'` Conditions**:
    - The `LIKE '%キャビンアテンダント%'` conditions are applied to multiple columns across different tables. These conditions prevent the use of indexes, leading to full-table scans and poor performance.

2. **Redundant Filtering**:
    - The `WHERE` clause applies the same filter (`LIKE '%キャビンアテンダント%'`) to multiple columns. This redundancy can be optimized by pre-filtering or using full-text search.

---

## Proposed Improvements

**Replace `LIKE` condition with `MATCH`
```sql
WHERE (
  MATCH(JobCategories.name) AGAINST('キャビンアテンダント' IN BOOLEAN MODE) OR
  MATCH(JobTypes.name) AGAINST('キャビンアテンダント' IN BOOLEAN MODE) OR
  MATCH(Jobs.name, Jobs.description, Jobs.detail, Jobs.business_skill, Jobs.knowledge, Jobs.location, Jobs.activity)
    AGAINST('キャビンアテンダント' IN BOOLEAN MODE) OR
  MATCH(Personalities.name) AGAINST('キャビンアテンダント' IN BOOLEAN MODE) OR
  MATCH(PracticalSkills.name) AGAINST('キャビンアテンダント' IN BOOLEAN MODE) OR
  MATCH(BasicAbilities.name) AGAINST('キャビンアテンダント' IN BOOLEAN MODE) OR
  MATCH(Tools.name) AGAINST('キャビンアテンダント' IN BOOLEAN MODE) OR
  MATCH(CareerPaths.name) AGAINST('キャビンアテンダント' IN BOOLEAN MODE) OR
  MATCH(RecQualifications.name) AGAINST('キャビンアテンダント' IN BOOLEAN MODE) OR
  MATCH(ReqQualifications.name) AGAINST('キャビンアテンダント' IN BOOLEAN MODE)
)
```

## The query used a lot of `LEFT JOIN` which increase the complexity and execution time.

**Remove the unnecessary join that may not contribute to the final results**

## Instead of selecting all the columns, only specify the columns that you need. Example:  

```sql
SELECT 
  Jobs.id,
  Jobs.name,
  Jobs.description,
  JobCategories.name AS category_name,
  JobTypes.name AS type_name
```


### These are the improvement that i can see. If the `indexes` were created and used on joined table. There should be no issue, but if there is no index , we may need to crate index for the necessary columns that used.

